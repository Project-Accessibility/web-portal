<?php

use App\Models\Question;
use App\Models\Section;
use Tests\TestCase;

class questionTest extends TestCase
{
    /** @test */
    public function question_test()
    {
        $section = Section::factory()->create();

        $questionOne = Question::create([
            'section_id' => $section->id,
            'title' => 'Eerste versie',
            'question' => 'test'
        ]);

        dd($questionOne);

        $questionTwo = Question::factory()->create([
            'title' => 'Tweede versie',
            'section_id' => $questionOne->section_id,
            'question_id' => $questionOne->question_id,
            'version' => $questionOne->version++,
        ]);

        dd(Question::all());
    }
}
