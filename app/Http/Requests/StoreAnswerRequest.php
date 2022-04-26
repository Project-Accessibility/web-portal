<?php

namespace App\Http\Requests;

use App\Models\Participant;
use App\Models\Question;
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

        return $participant != null && $question != null && $participant->questionnaire->id == $question->section->questionnaire->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'audio' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ];
    }
}
