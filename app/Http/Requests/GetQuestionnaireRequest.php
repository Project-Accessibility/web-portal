<?php

namespace App\Http\Requests;

use App\Models\Participant;
use Illuminate\Foundation\Http\FormRequest;

class GetQuestionnaireRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $participant = Participant::whereCode($this->route('code'))
                ->whereFinished(false)
                ->firstOrFail();
            if (!$participant->questionnaire->open) {
                $validator
                    ->errors()
                    ->add('Questionnaire', 'Vragenlijst is gesloten.');
            }
        });
    }
}
