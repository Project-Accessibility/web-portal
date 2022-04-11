<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'radius' => 'min:10',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
        ];
    }
}
