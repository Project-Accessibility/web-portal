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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class QuestionController extends Controller
{
    public function get(int $question, string $code): Model
    {
        return Question::with([
            'options.answers' => function (HasMany $answers) use ($code) {
                $answers->whereHas('participant', function (
                    Builder $participant,
                ) use ($code) {
                    $participant->where('code', $code);
                });
            },
        ])->findOrFail($question);
    }

    public function answer(
        StoreAnswerRequest $request,
        Question $question,
        string $code,
    ): JsonResponse {
        // validation
        $request->validated();

        $options = $question->options;
        $participant = Participant::whereCode($code)->first();

        // Add answers
        $this->removeAnswers($request, $participant);
        $options->map(function ($option) use ($request, $participant) {
            $this->saveAnswer($option, $request, $participant);
        });
        return response()->json([
            'message' => 'answers saved!',
        ]);
    }

    private function removeAnswers($request, $participant)
    {
        $answers = $participant->answers;
        $answers->map(function ($answer) use ($request) {
            if (
                in_array($answer->option()->type, [
                    QuestionOptionType::VIDEO,
                    QuestionOptionType::IMAGE,
                    QuestionOptionType::VIDEO,
                ])
            ) {
                $value = $request->file($answer->option()->type->value);
            } elseif (
                $answer->option()->type == QuestionOptionType::MULTIPLE_CHOICE
            ) {
                $value = json_decode(
                    $request->get($answer->option()->type->value),
                );
            } else {
                $value = $request->get($answer->option()->type->value);
            }
            if ($value == null) {
                $answer->delete();
            }
        });
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
                $answer->answer = [$open];
                break;
            case QuestionOptionType::VOICE:
                $audios = $request->file('VOICE');
                if (!$audios) {
                    return;
                }
                $answer->answer = $this->handleFiles($audios, 'audios');
                break;
            case QuestionOptionType::IMAGE:
                $images = $request->file('IMAGE');
                if (!$images) {
                    return;
                }
                $answer->answer = $this->handleFiles($images, 'images');
                break;
            case QuestionOptionType::VIDEO:
                $videos = $request->file('VIDEO');
                if (!$videos) {
                    return;
                }
                $answer->answer = $this->handleFiles($videos, 'videos');
                break;
            case QuestionOptionType::MULTIPLE_CHOICE:
                $answers = json_decode($request->get('MULTIPLE_CHOICE'));
                if (!$answers) {
                    return;
                }
                $answer->answer = $answers;
                break;
            default:
                abort(
                    ResponseAlias::HTTP_NOT_IMPLEMENTED,
                    'Deze functie werkt nog niet',
                );
        }
        $answer->save();
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
                array_push($links, $this->uploadFile($file, $path));
            }
        } else {
            // handle single file
            array_push($links, $this->uploadFile($files, $path));
        }
        return $links;
    }

    private function uploadFile($file, $path): string|UrlGenerator|Application
    {
        $uniqueId = uniqid();
        $extension = $file->getClientOriginalExtension();
        $filename =
            Carbon::now()->format('Ymd') . '_' . $uniqueId . '.' . $extension;
        $filePath = url("/storage/upload/files/$path/" . $filename);
        $file->storeAs("public/upload/files/$path/", $filename);
        return $filePath;
    }
}
