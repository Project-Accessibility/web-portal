@extends('layouts.app')

@section('content')
    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                #{{$participant->code}}
            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <form method="POST" action="{{ route('participants.remove', [$research->id, $questionnaire->id, $participant->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove">
                    Participant verwijderen
                </x-button>
            </form>
        </div>
    </div>
    @foreach($participant->answers as $answer)
        <div class="d-flex gap-4">
            <div class="col-auto text-center align-end justify-content-end flex-column d-none d-sm-flex">
                <div class="d-flex justify-content-center h-50">
                    <div class="vr"></div>
                </div>
                <span class="badge badge-pill bg-light border rounded-circle">&nbsp;</span>
                <div class="d-flex justify-content-center h-50">
                    <div class="vr"></div>
                </div>
            </div>
            <div class="col py-2">
                <div class="card">
                    <div class="card-body d-flex flex-column gap-2">
                        <b class="card-text">{{ 'Vraag \'' . $answer->questionOption->question->title . '\' van onderdeel \'' . $answer->questionOption->question->section->title . '\' beantwoord.' }}</b>
                        <small>{{ $answer->updated_at }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if(count($participant->answers) === 0)
        <div class="mt-2">
            <span class="fs-5">Er zijn door deze participant nog geen acties uitgevoerd</span>
        </div>
    @endif
@endsection
