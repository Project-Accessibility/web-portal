@extends('layouts.app')

@section('content')
    <h1 class="title">Onderdeel {{$section->id}} - Vraag {{$question->id}} - Participant #{{$participant->id}}</h1>
    <h2 class="h2">{{$question->question}}</h2>
    <div class="row">
        @foreach($answers as $answer)
            <div class="col-md-6">
                <h3 class="h4">{{ $answer->option()->type->display() }}</h3>
                @switch($answer->option()->type)
                    @case(\App\Enums\QuestionOptionType::OPEN)
                    <p>{{$answer->answer['text']}}</p>
                    @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
