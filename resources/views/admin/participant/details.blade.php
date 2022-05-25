@extends('layouts.app')

@section('content')
    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                Participant #{{$participant->code}}
            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <form method="POST" id="deleteForm" action="{{ route('participants.remove', [$research->id, $questionnaire->id, $participant->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove" link="#" formId="deleteForm">
                    Participant verwijderen
                </x-button>
            </form>
        </div>
    </div>
    @foreach($questions as $question)
        <div class="d-flex gap-4">
            <div class="col-auto text-center align-end justify-content-end flex-column d-none d-sm-flex">
                <div class="d-flex justify-content-center h-50">
                    <div class="vr"></div>
                </div>
                <span aria-hidden="true" class="badge badge-pill bg-light border rounded-circle">&nbsp;</span>
                <div class="d-flex justify-content-center h-50">
                    <div class="vr"></div>
                </div>
            </div>
            <div class="col py-2">
                <a class="text-decoration-none" href="{{ route('questions.answer', [$research->id,$questionnaire->id, $question->section->id, $question->id, $participant->id]) }}">
                    <div class="card participant-timeline-card">
                        <div class="card-body d-flex justify-content-between align-items-center gap-2">
                            <div class="d-flex flex-column">
                                <b class="card-text">{{ 'Vraag \'' . $question->title . '\' van onderdeel \'' . $question->section->title . '\' beantwoord.' }}</b>
                                <small>{{ $question->latest_answer }}</small>
                            </div>
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
    @if(count($questions) === 0)
        <div class="mt-2">
            <span class="fs-5">Er zijn door deze participant nog geen acties uitgevoerd</span>
        </div>
    @endif
@endsection
