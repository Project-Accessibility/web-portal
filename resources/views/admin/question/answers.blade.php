@extends('layouts.app')

@section('content')
    <h1 class="title">Onderdeel {{$section->id}} - Vraag {{$question->id}}</h1>
    <div class="col-md-auto d-flex align-items-center gap-2">
        <h2 class="h2">{{$question->question}}</h2>
        <span>
            @if($question->latestVersion() == $question->version)
                <span class="badge rounded-pill bg-secondary">Laatste versie</span>
            @else
                <span class="badge rounded-pill bg-secondary">Versie {{$question->version}}</span>
            @endif
        </span>
    </div>
    <hr/>
    <div class="row">
    </div>
@endsection
