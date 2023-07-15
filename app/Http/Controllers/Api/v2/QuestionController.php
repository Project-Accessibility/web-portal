<?php

namespace App\Http\Controllers\Api\v2;

use App\Enums\QuestionOptionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class QuestionController extends Controller
{
    public function answer(
        StoreAnswerRequest $request,
        Question $question,
        string $code,
    ): JsonResponse {
        $participant = Participant::whereCode($code)
            ->whereFinished(false)
            ->first();

        $question->options->map(
            fn(QuestionOption $option) => $this->answerOption(
                $option,
                $request,
                $participant,
            ),
        );

        return response()->json([
            'message' => 'answers saved!',
        ]);
    }

    private function answerOption(
        QuestionOption $option,
        StoreAnswerRequest $request,
        Participant $participant,
    ): void {
        $apiKey = $option->type->value;

        $multipart = $this->getMultipart($request, $apiKey);

        switch ($option->type) {
            case QuestionOptionType::OPEN:
            case QuestionOptionType::MULTIPLE_CHOICE:
            case QuestionOptionType::RANGE:
                $this->answerSimple($multipart, $option, $participant);
                break;
            case QuestionOptionType::IMAGE:
            case QuestionOptionType::VOICE:
            case QuestionOptionType::VIDEO:
                $this->answerFiles($multipart, $option, $participant);
                break;
        }
    }

    private function getMultipart(
        StoreAnswerRequest $request,
        string $apiKey,
    ): mixed {
        return $request->get($apiKey) ?? ($request->file($apiKey) ?? null);
    }

    private function answerSimple(
        string|array|null $value,
        QuestionOption $option,
        Participant $participant,
    ): void {
        $answer = $this->getAnswerForParticipant($option, $participant);

        if (!$value) {
            $answer->delete();

            return;
        }

        $answer->values = is_array($value) ? $value : [$value];

        $answer->save();
    }

    private function answerFiles(
        UploadedFile|array|string|null $files,
        QuestionOption $option,
        Participant $participant,
    ): void {
        $answer = $this->getAnswerForParticipant($option, $participant);

        if (empty($files)) {
            if ($answer->values) {
                $this->removeFiles(collect($answer->values));
            }

            $answer->delete();

            return;
        }

        $files = is_array($files) ? $files : [$files];

        $path = $this->getPathByQuestionOption($option);

        if (!$path) {
            return;
        }

        $values = collect($files)
            ->map(
                fn(UploadedFile|string|null $file) => $this->uploadFile(
                    $file,
                    $path,
                ),
            )
            ->filter();

        $needsToBeRemoved = collect($answer->values)->diff($values);

        $this->removeFiles($needsToBeRemoved);

        $answer->values = $values->toArray();

        $answer->save();
    }

    private function getPathByQuestionOption(
        QuestionOption $questionOption,
    ): ?string {
        return match ($questionOption->type) {
            QuestionOptionType::IMAGE => 'images',
            QuestionOptionType::VIDEO => 'videos',
            QuestionOptionType::VOICE => 'audios',
            default => null,
        };
    }

    private function uploadFile(
        UploadedFile|string|null $file,
        string $path,
    ): ?string {
        if (!$file) {
            return null;
        }

        if (is_string($file) && URL::isValidUrl($file)) {
            return $file;
        }

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

    private function getAnswerForParticipant(
        QuestionOption $option,
        Participant $participant,
    ): Answer {
        return Answer::whereParticipantId($participant->id)
            ->whereQuestionOptionId($option->id)
            ->firstOrNew([
                'participant_id' => $participant->id,
                'question_option_id' => $option->id,
            ]);
    }

    private function removeFiles(Collection $fileUrls): void
    {
        $fileUrls->each(fn(string $fileUrl) => $this->removeFile($fileUrl));
    }

    private function removeFile(string $url): void
    {
        $url = storage_path('app/public' . explode('storage', $url)[1]);
        unlink($url);
    }
}
