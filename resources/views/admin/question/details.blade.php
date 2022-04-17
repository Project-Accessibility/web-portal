@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                {{$question->title}}
            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button type="secondary"
                          link="{{ route('questions.edit', [$research->id,$questionnaire->id, $section->id, $question->id]) }}">
                    Vraag aanpassen
                </x-button>
            </div>
            <form method="POST"
                  action="{{ route('questions.remove', [$research->id, $questionnaire->id, $section->id, $question->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove">
                    Vraag verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Gegevens</h2>
            <div class="col-sm-6">
                <strong>Vraag</strong>
                <div>
                    {{ $question->question }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Antwoordmogelijkheden</h2>
        </div>
    </div>
@endsection
