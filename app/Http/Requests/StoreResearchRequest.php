<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'template' => 'nullable|exists:researches,id'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
        ];
    }
}
