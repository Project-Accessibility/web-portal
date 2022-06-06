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
                <x-button type="secondary" link="{{ route('questionnaires.edit', [$research->id, $questionnaire->id]) }}">
                    Vragenlijst aanpassen
                </x-button>
            </div>
            <form method="POST" id="deleteForm" action="{{ route('questionnaires.remove', [$research->id, $questionnaire->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove" link="#" formId="deleteForm">
                    Vragenlijst verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs title="questionnaireDetails" :tabs="['Details', 'Onderdelen', 'Resultaten', 'Participanten']">
        @section('details')
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
            <div class="row mt-1">
                <div class="col-sm-6">
                    <strong>Helppagina tekst</strong>
                    <div>
                        {{ $questionnaire->help }}
                    </div>
                </div>
            </div>
        @endsection
        @section('onderdelen')
            <div class="mt-2">
                <div class="row justify-content-end">
                    <div class="w-auto">
                        <x-button type="secondary" link="{{ route('sections.create', [$questionnaire->research->id, $questionnaire->id]) }}">
                            Nieuwe Onderdeel
                        </x-button>
                    </div>
                </div>
                <x-table :tableLinks="$sectionLinks" :headers="$sectionHeaders" :items="$sections" :keys="$sectionKeys" :row-link="$sectionRowLink"/>
            </div>
        @endsection
        @section('resultaten')
            @include('admin.questionnaire.answers')
        @endsection
        @section('participanten')
            <div class="mt-2">
                <div class="row justify-content-end">
                    <div class="w-auto">
                        <form method="POST" action="{{ route('participants.store', [$research->id, $questionnaire->id]) }}">
                            @csrf
                            <x-button type="secondary">
                                Nieuwe participant
                            </x-button>
                        </form>
                    </div>
                </div>
                <x-table :headers="$participantHeaders" :items="$participants" :keys="$participantKeys" :row-link="$participantRowLink"/>
            </div>
        @endsection
    </x-tabs>
@endsection
