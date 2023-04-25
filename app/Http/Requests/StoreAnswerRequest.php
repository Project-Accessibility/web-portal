<?php

namespace App\Http\Requests;

use App\Enums\QuestionOptionType;
use App\Models\Participant;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class StoreAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        $participant = Participant::whereCode($this->route('code'))
            ->whereFinished(false)
            ->first();
        $question = $this->route('question');

        return $participant != null &&
            $question != null &&
            $participant->questionnaire->id ==
                $question->section->questionnaire->id;
    }

    public function rules(): array
    {
        return [];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(fn(Validator $validator)
            => $this->afterValidation($validator)
        );
    }

    private function afterValidation(Validator $validator): void
    {
        $question = $this->route('question');

        $this->getAllAnswers($question, $validator)->each(function (
            $answer,
            $questionOption,
        ) use ($validator, $question) {
            switch ($questionOption) {
                case QuestionOptionType::VIDEO->value:
                    $this->validateFiles(
                        $validator,
                        $answer,
                        ['mp4', 'mov', 'm4v'],
                        50,
                        QuestionOptionType::VIDEO,
                    );
                    break;
                case QuestionOptionType::IMAGE->value:
                    $this->validateFiles(
                        $validator,
                        $answer,
                        [
                            'jpg',
                            'jpeg',
                            'png',
                            'bmp',
                            'gif',
                            'svg',
                            'webp'
                        ],
                        10,
                        QuestionOptionType::IMAGE,
                    );
                    break;
                case QuestionOptionType::VOICE->value:
                    $this->validateFiles(
                        $validator,
                        $answer,
                        [
                            'audio/mpeg',
                            'mpga',
                            'mp3',
                            'm4a',
                            'mp4',
                            'wav',
                            'aac',
                        ],
                        5,
                        QuestionOptionType::VOICE,
                    );
                    break;
                case QuestionOptionType::MULTIPLE_CHOICE->value:
                    $questionOption = $question->getOption(
                        QuestionOptionType::MULTIPLE_CHOICE,
                    );

                    $this->validateMultipleChoice(
                        $validator,
                        $answer,
                        $questionOption,
                    );
                    break;
                case QuestionOptionType::OPEN->value:
                case QuestionOptionType::RANGE->value:
                    break;
                default:
                    $validator
                        ->errors()
                        ->add(
                            $questionOption,
                            $questionOption . ' bestaat niet.',
                        );
            }
        });
    }

    private function validateMultipleChoice(
        Validator               $validator,
        array|string            $multipleChoice,
        Model|QuestionOption    $questionOption,
    ): void {
        $multipleChoice = is_string($multipleChoice)
            ? $this->collect([$multipleChoice])
            : $this->collect($multipleChoice);

        if (!$multipleChoice) {
            $validator
                ->errors()
                ->add(
                    QuestionOptionType::MULTIPLE_CHOICE->value,
                    QuestionOptionType::MULTIPLE_CHOICE->value .
                        ' is geen geldige JSON.',
                );
        }

        if (isset($questionOption->extra_data['multiple'])) {
            $multiple = (bool) $questionOption->extra_data['multiple'];

            if (count($multipleChoice) > 1 && !$multiple) {
                $validator
                    ->errors()
                    ->add(
                        QuestionOptionType::MULTIPLE_CHOICE->value,
                        QuestionOptionType::MULTIPLE_CHOICE->value .
                            ' mag maar één keuze bevatten.',
                    );
            }
        }

        if (isset($option->extra_data['values'])) {
            $values = (array) $option->extra_data['values'];

            $multipleChoice->each(function (string $value) use (
                $values,
                $validator,
            ) {
                if (!in_array($value, $values)) {
                    $validator
                        ->errors()
                        ->add(
                            QuestionOptionType::MULTIPLE_CHOICE->value,
                            QuestionOptionType::MULTIPLE_CHOICE->value .
                                " bevat niet de mogelijkheid om $value te antwoorden",
                        );
                }
            });
        }
    }

    private function validateFiles(
        Validator           $validator,
        array|UploadedFile|string  $files,
        array               $mimes,
        int                 $maxFileSizeMB,
        QuestionOptionType  $optionType,
    ): void {
        if (! is_array($files)) {
            $this->validateFile(
                $validator,
                $files,
                $mimes,
                $maxFileSizeMB,
                $optionType,
            );

            return;
        }

        collect($files)->each(
            fn(UploadedFile|string $uploadedFile) => $this->validateFile(
                $validator,
                $uploadedFile,
                $mimes,
                $maxFileSizeMB,
                $optionType,
            ),
        );
    }

    private function validateFile(
        Validator $validator,
        UploadedFile|string $uploadedFile,
        array $mimes,
        int $maxFileSize,
        QuestionOptionType  $optionType
    ): void {
        if (is_string($uploadedFile) && URL::isValidUrl($uploadedFile)) {
            return;
        }

        if (!is_a($uploadedFile, UploadedFile::class)) {
            $validator
                ->errors()
                ->add(
                    $optionType->value,
                    $optionType->display() . ' moet een bestand zijn.',
                );

            return;
        }

        if (!$this->fileMimes($uploadedFile, $mimes)) {
            $validator
                ->errors()
                ->add(
                    $optionType->value,
                    $optionType->display() .
                        ' moet een bestand zijn met de extensie: ' .
                        implode(',', $mimes),
                );
        }

        if (!$this->fileSize($uploadedFile, $maxFileSize)) {
            $validator
                ->errors()
                ->add(
                    $optionType->value,
                    $optionType->display() .
                        " mag maximaal ${maxFileSize}kb zijn.",
                );
        }
    }

    private function fileMimes(UploadedFile $uploadedFile, array $mimes): bool
    {
        return in_array($uploadedFile->extension(), $mimes);
    }

    private function fileSize(
        UploadedFile $uploadedFile,
        int $maxFileSize,
    ): bool {
        return $uploadedFile->getSize() / 1000000 <= $maxFileSize;
    }

    private function getAllAnswers(
        object $question,
        Validator $validator,
    ): Collection {
        return $question
            ->options()
            ->pluck('type')
            ->pluck('value')
            ->mapWithKeys(function (string $questionOption) use ($validator) {
                $answer =
                    $this->input($questionOption) ??
                    ($this->file($questionOption) ?? null);

                if (!$answer) {
                    return [];
                }

                return [$questionOption => $answer];
            });
    }
}
