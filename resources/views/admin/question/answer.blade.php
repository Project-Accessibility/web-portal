@extends('layouts.app')

@section('content')
    <h1 class="title">Onderdeel {{$section->id}} - Vraag {{$question->id}} - Participant #{{$participant->id}}</h1>
    <h2 class="h2">{{$question->question}}</h2>
    <div class="row">
        @foreach($options as $answers)
            <div class="col-md-6 mt-2">
                <h3 class="h4">{{ $answers[0]->option()->type->display() }}</h3>
                @switch($answers[0]->option()->type)
                    @case(\App\Enums\QuestionOptionType::OPEN)
                        <p>{{$answers[0]->answer['text']}}</p>
                        @break;
                    @case(\App\Enums\QuestionOptionType::VOICE)
                        <div class="row gy-2">
                            @foreach($answers as $answer)
                                <audio class="col-md-6" controls>
                                    <source src="{{ $answer->answer['link'] }}" type="audio/mpeg">
                                </audio>
                            @endforeach
                        </div>
                        @break;
                    @case(\App\Enums\QuestionOptionType::IMAGE)
                        <div class="row gy-2">
                            @foreach($answers as $answer)
                                <img src="{{ $answer->answer['link'] }}" class="col-md-6" alt="image">
                            @endforeach
                        </div>
                        @break;
                    @case(\App\Enums\QuestionOptionType::VIDEO)
                        <div class="row gy-2">
                            @foreach($answers as $answer)
                                <video src="{{ $answer->answer['link'] }}" class="col-md-6" controls>
                            @endforeach
                        </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::MULTIPLE_CHOICE)
                        <div class="row gy-2">
                            <ul class="list-group">
                                @foreach($answers[0]->answer['options'] as $answer)
                                    <li class="list-group-item {{in_array($answer, $answers[0]->answer['selected']) ? 'selected' : ''}}">{{ $answer }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
