<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestInputsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'money' => 'required|max:255',
            'image' => 'required|max:255',
            'password' => 'required|max:255',
            'selectList' => 'required|max:255',
            'datum' => 'after:tomorrow',
            'switch' => 'Array',
            'range' => 'numeric|min:2',
            'text' => 'max:255',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
        ];
    }
}
