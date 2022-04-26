<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionOptionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Participant;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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

    public function answer(StoreAnswerRequest $request, Question $question, string $code): JsonResponse
    {
        // validation
        $request->validated();

        $options = $question->options;
        $participant = Participant::whereCode($code)->first();

        // Add answers
        // Todo: Make it updatable
        $options->map(function ($option) use ($participant, $request) {
            switch ($option->type){
                case QuestionOptionType::OPEN:
                    $open = $request->get('OPEN');
                    $option->answers()->create([
                        'participant_id' => $participant->id,
                        'answer' => ['text' => $open]
                    ]);
                    break;
                case QuestionOptionType::VOICE:
                    $audios = $request->file('VOICE');
                    $this->handleFile($option, $participant->id,  $audios, 'audios');
                    break;
                case QuestionOptionType::IMAGE:
                    $images = $request->file('IMAGE');
                    $this->handleFile($option, $participant->id,  $images, 'images');
                    break;
                case QuestionOptionType::VIDEO:
                    $images = $request->file('VIDEO');
                    $this->handleFile($option, $participant->id,  $images, 'videos');
                    break;
                case QuestionOptionType::MULTIPLE_CHOICE:
                    $answers = json_decode($request->get('MULTIPLE_CHOICE'));
                    $option->answers()->create([
                        'participant_id' => $participant->id,
                        'answer' => ['options' => $option->extra_data['values'], 'selected' => $answers]
                    ]);
                    break;
                default:
                    abort(ResponseAlias::HTTP_NOT_IMPLEMENTED, 'Deze functie werkt nog niet');
            }
        });
        return response()->json([
            'message' => 'answers saved!'
        ]);
    }

    private function handleFile($option, $participantId, $files, $path): void
    {
        if (!$files) {
            return;
        }
        if (is_array($files)) {
            // handle multiple files
            foreach ($files as $file) {
                $option->answers()->create([
                    'participant_id' => $participantId,
                    'answer' => ['link' => $this->uploadFile($file, $path)]
                ]);
            }
        } else {
            // handle single file
            $option->answers()->create([
                'participant_id' => $participantId,
                'answer' => ['link' => $this->uploadFile($files, $path)]
            ]);
        }
    }

    private function uploadFile($file, $path): string|UrlGenerator|Application
    {
        $uniqueId = uniqid();
        $extension = $file->getClientOriginalExtension();
        $filename = Carbon::now()->format('Ymd') . '_' . $uniqueId . '.' . $extension;
        $filePath = url("/storage/upload/files/$path/" . $filename);
        $file->storeAs("public/upload/files/$path/", $filename);
        return $filePath;
    }
}
