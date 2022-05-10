<?php

namespace App\Http\Requests;

use App\Enums\QuestionOptionType;
use App\Models\Participant;
use Illuminate\Foundation\Http\FormRequest;

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
            'VOICE.*' => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac|max:2048',
            'VOICE' => 'nullable|max:10',
            'IMAGE.*' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            'IMAGE' => 'nullable|max:10',
            'VIDEO.*' => 'file|mimes:mp4|max:20000',
            'VIDEO' => 'nullable|max:10',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $options = $this->route('question')->options();
            $this->checkIfValidAnswers($validator, $options->get());
            $multipleChoice = json_decode($this->get('MULTIPLE_CHOICE'));
            if (is_array($multipleChoice) && count($multipleChoice) > 0) {
                $this->checkIfMultipleChoiceValid(
                    $validator,
                    $options,
                    $multipleChoice,
                );
            }
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
}
