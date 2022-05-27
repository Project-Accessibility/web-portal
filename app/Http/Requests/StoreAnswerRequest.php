<?php

namespace App\Http\Requests;

use App\Enums\QuestionOptionType;
use App\Models\Participant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;

class StoreAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $participant = Participant::whereCode($this->route('code'))->first();
        $question = $this->route('question');

        return $participant != null &&
            $question != null &&
            $participant->questionnaire->id ==
                $question->section->questionnaire->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'OPEN' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $options = $this->route('question')->options();
            $this->checkIfValidAnswers($validator, $options->get());
            $multipleChoice = json_decode($this->get('MULTIPLE_CHOICE'));
            if ($this->get('MULTIPLE_CHOICE') && !is_array($multipleChoice)) {
                $validator
                    ->errors()
                    ->add(
                        'MULTIPLE_CHOICE',
                        'Waarde is niet van het type array',
                    );
            }
            if (is_array($multipleChoice) && count($multipleChoice) > 0) {
                $this->checkIfMultipleChoiceValid(
                    $validator,
                    $options,
                    $multipleChoice,
                );
            }
            $this->validateUploads($validator);
        });
    }

    private function checkIfValidAnswers($validator, $options): void
    {
        $questionOptionTypes = $options
            ->pluck('type')
            ->pluck('value')
            ->toArray();
        $allOptionTypes = QuestionOptionType::cases();
        foreach ($allOptionTypes as $optionType) {
            $optionType = $optionType->value;
            if (
                $this->get($optionType) != null &&
                !in_array($optionType, $questionOptionTypes)
            ) {
                $validator
                    ->errors()
                    ->add(
                        $optionType,
                        $optionType . ' antwoord is geen vraag optie.',
                    );
            }
        }
    }

    private function checkIfMultipleChoiceValid(
        $validator,
        $options,
        $multipleChoice,
    ): void {
        $option = $options
            ->where('type', '=', QuestionOptionType::MULTIPLE_CHOICE->value)
            ->first();
        if ($option) {
            if (
                !$option->extra_data['multiple'] &&
                count($multipleChoice) > 1
            ) {
                $validator
                    ->errors()
                    ->add(
                        'MULTIPLE_CHOICE',
                        'Er kan maar een waarde gekozen worden.',
                    );
            }
            foreach ($multipleChoice as $value) {
                if (!in_array($value, $option->extra_data['values'])) {
                    $validator
                        ->errors()
                        ->add(
                            'MULTIPLE_CHOICE',
                            'Meerkeuze heeft deze waardes niet.',
                        );
                    return;
                }
            }
        }
    }

    private function validateUploads($validator): void
    {
        $types = ['VOICE', 'IMAGE', 'VIDEO'];
        foreach ($types as $type) {
            $files = $this->file($type);
            if ($files) {
                if (count($files) > 10) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'Er mogen maximaal 10 bestanden worden geupload.',
                        );
                }
                foreach ($files as $file) {
                    $this->validateFile($type, $file, $validator);
                }
            }
        }
    }

    private function validateFile(
        string $type,
        UploadedFile $file,
        Validator $validator,
    ) {
        switch ($type) {
            case 'VOICE':
                $acceptedMimeTypes = ['audio/mp3', 'audio/m4a', 'audio/mp4'];
                if (!in_array($file->getMimeType(), $acceptedMimeTypes)) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'Het audio bestand moet van het type audio/mp3,audio/m4a of audio/mp4 zijn.',
                        );
                }
                if ($file->getSize() > 50000) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'Het audio bestand mag niet groter dan 50000 kb zijn.',
                        );
                }
                break;
            case 'IMAGE':
                $acceptedMimeTypes = [
                    'image/jpg',
                    'image/jpeg',
                    'image/png',
                    'image/bmp',
                    'image/gif',
                    'image/svg',
                    'image/webp',
                ];
                if (!in_array($file->getMimeType(), $acceptedMimeTypes)) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'De afbeelding moet van het type jpg,jpeg,png,bmp,gif,svg of webp zijn.',
                        );
                }
                if ($file->getSize() > 9000) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'De afbeelding mag niet groter dan 9000 kb zijn.',
                        );
                }
                break;
            case 'VIDEO':
                $acceptedMimeTypes = ['video/mp4', 'video/mov', 'video/m4v'];
                if (!in_array($file->getMimeType(), $acceptedMimeTypes)) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'Het video bestand moet van het type mp4, mov of m4v zijn.',
                        );
                }
                if ($file->getSize() > 50000) {
                    $validator
                        ->errors()
                        ->add(
                            $type,
                            'Het video bestand mag niet groter dan 50000 kb zijn.',
                        );
                }
                break;
        }
    }
}
