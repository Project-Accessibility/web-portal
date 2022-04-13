<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionnaireRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->radius && intval($this->radius) < 10) {
                $validator
                    ->errors()
                    ->add('radius', 'Radius moet hoger of gelijk aan 10 zijn.');
            }
        });
    }

    public function attributes()
    {
        return [
            'title' => 'titel',
        ];
    }
}
