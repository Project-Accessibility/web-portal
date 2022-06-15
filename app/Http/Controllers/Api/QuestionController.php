<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionOptionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class QuestionController extends Controller
{
    public function answer(
        StoreAnswerRequest $request,
        Question $question,
        string $code,
    ): JsonResponse {
        // validation
        $request->validated();

        $options = $question->options;
        $participant = Participant::whereCode($code)
            ->whereFinished(false)
            ->first();

        // Add answers
        $options->map(function ($option) use ($request, $participant) {
            $this->removeAnswers($request, $participant, $option);
            $this->saveAnswer($option, $request, $participant);
        });
        return response()->json([
            'message' => 'answers saved!',
        ]);
    }

    private function removeAnswers($request, $participant, $option)
    {
        $answer = Answer::whereParticipantId($participant->id)
            ->whereQuestionOptionId($option->id)
            ->first();
        if ($answer == null) {
            return;
        }
        if (
            in_array($answer->option->type, [
                QuestionOptionType::VOICE,
                QuestionOptionType::IMAGE,
                QuestionOptionType::VIDEO,
            ])
        ) {
            $value = $request->file($answer->option->type->value);
            if ($value == null) {
                $this->removeFiles($answer->values);
            }
        } elseif (
            $answer->option->type == QuestionOptionType::MULTIPLE_CHOICE
        ) {
            $value = json_decode($request->get($answer->option->type->value));
        } else {
            $value = $request->get($answer->option->type->value);
        }
        if ($value == null) {
            $answer->delete();
        }
    }

    private function saveAnswer($option, $request, $participant)
    {
        $answer = Answer::whereParticipantId($participant->id)
            ->whereQuestionOptionId($option->id)
            ->first();
        if ($answer == null) {
            $answer = new Answer();
            $answer->question_option_id = $option->id;
            $answer->participant_id = $participant->id;
        }
        switch ($option->type) {
            case QuestionOptionType::OPEN:
                $open = $request->get('OPEN');
                if (!$open) {
                    return;
                }
                $answer->values = [$open];
                break;
            case QuestionOptionType::VOICE:
                $audios = $request->file('VOICE');
                if (!$audios) {
                    return;
                }
                $this->removeFiles($answer->values);
                $answer->values = $this->handleFiles($audios, 'audios');
                break;
            case QuestionOptionType::IMAGE:
                $images = $request->file('IMAGE');
                if (!$images) {
                    return;
                }
                $this->removeFiles($answer->values);
                $answer->values = $this->handleFiles($images, 'images');
                break;
            case QuestionOptionType::VIDEO:
                $videos = $request->file('VIDEO');
                if (!$videos) {
                    return;
                }
                $this->removeFiles($answer->values);
                $answer->values = $this->handleFiles($videos, 'videos');
                break;
            case QuestionOptionType::MULTIPLE_CHOICE:
                $answers = json_decode($request->get('MULTIPLE_CHOICE'));
                if (!$answers) {
                    return;
                }
                $answer->values = $answers;
                break;
            case QuestionOptionType::RANGE:
                $range = $request->get('RANGE');
                if (!$range) {
                    return;
                }
                $answer->values = [$range];
                break;
            default:
                abort(
                    ResponseAlias::HTTP_NOT_IMPLEMENTED,
                    'Deze functie werkt nog niet',
                );
        }
        $answer->save();
    }

    private function removeFiles($filePaths): void
    {
        if ($filePaths) {
            foreach ($filePaths as $filePath) {
                $this->removeFile($filePath);
            }
        }
    }

    private function removeFile($filePath): void
    {
        $filePath = storage_path(
            'app/public/' . explode('storage', $filePath)[1],
        );
        unlink($filePath);
    }

    private function handleFiles($files, $path): array
    {
        $links = [];
        if (!$files) {
            return $links;
        }
        if (is_array($files)) {
            // handle multiple files
            foreach ($files as $file) {
                $links[] = $this->uploadFile($file, $path);
            }
        } else {
            // handle single file
            $links[] = $this->uploadFile($files, $path);
        }
        return $links;
    }

    private function uploadFile($file, $path): string|UrlGenerator|Application
    {
        if (env('APP_ENV') === 'local') {
            URL::forceRootUrl(Config::get('app.url'));
        }

        $uniqueId = uniqid();
        $extension = $file->getClientOriginalExtension();
        $filename =
            Carbon::now()->format('Ymd') . '_' . $uniqueId . '.' . $extension;
        $filePath = url("/storage/upload/files/$path/" . $filename);
        $file->storeAs("public/upload/files/$path/", $filename);
        return $filePath;
    }
}
