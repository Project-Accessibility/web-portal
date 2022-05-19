<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'question' => 'required|max:255',
            'list' => 'required_if:MULTIPLE_CHOICE,"1"|array|min:2',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
            'question' => 'vraag',
        ];
    }

    public function messages()
    {
        return [
            'list.required_if' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden veriest.',
            'list.array' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden veriest.',
            'list.min' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden veriest.',
        ];
    }
}
