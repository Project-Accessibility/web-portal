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
            'rangeMin' => 'required_if:RANGE,"1"|nullable|integer|min:0',
            'rangeMax' => 'required_if:RANGE,"1"|nullable|integer|gt:rangeMin',
            'rangeStep' => 'required_if:RANGE,"1"|nullable|integer|min:1',
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
            'rangeMin.required_if' =>
                'Een minimum is vereist bij een schaal vraag.',
            'rangeMax.required_if' =>
                'Een maximum is vereist bij een schaal vraag.',
            'rangeStep.required_if' =>
                'Een stap is vereist bij een schaal vraag.',
            'rangeMin.min' =>
                'De mininum van een schaal vraag moet minimaal 0 zijn.',
            'rangeMax.gt' =>
                'De maximum van een schaal vraag moet groter dan het minimum zijn.',
            'rangeStep.min' =>
                'De stap van een schaal vraag moet minimaal 1 zijn.',
            'list.required_if' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden vereist.',
            'list.array' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden vereist.',
            'list.min' =>
                'Bij een meerkeuze vraag zijn minimaal twee mogelijkheden vereist.',
        ];
    }
}
