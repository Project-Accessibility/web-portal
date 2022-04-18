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
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
            'question' => 'vraag',
        ];
    }
}
