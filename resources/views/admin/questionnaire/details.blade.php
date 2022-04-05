@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                {{$questionnaire->title}}
            </h1>
            <span>
            @if($questionnaire->open)
                <span class="badge rounded-pill bg-success">Open</span>
            @else
                <span class="badge rounded-pill bg-danger">Gesloten</span>
            @endif
        </span>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button type="secondary" link="{{ route('questionnaires.edit', [$questionnaire->research_id, $questionnaire->id]) }}">
                    Vragenlijst aanpassen
                </x-button>
            </div>
            <form method="POST" action="{{ route('questionnaires.remove', [$questionnaire->research_id, $questionnaire->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove">
                    Vragenlijst verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs title="questionnaireDetails" :tabs="['Details', 'Onderdelen', 'Resultaten', 'Participanten']">
        @section('Details')
            <div class="row mt-2">
                <div class="col-sm-6">
                    <strong>Omschrijving</strong>
                    <div>
                        {{ $questionnaire->description }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <strong>Instructies</strong>
                    <div>
                        {{ $questionnaire->instructions }}
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <strong>Locatie foto's opslag</strong>
                <div>
                    <a href="{{ $questionnaire->teachable_machine_link }}">{{ $questionnaire->teachable_machine_link }}</a>
                </div>
            </div>
        @endsection
        @section('Onderdelen')
        @endsection
        @section('Resultaten')
        @endsection
        @section('Participanten')
        @endsection
    </x-tabs>
@endsection