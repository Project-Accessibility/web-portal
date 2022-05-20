@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <h1 class="title col-md-auto">{{$research->title}}</h1>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button type="secondary" link="{{ route('researches.edit', $research->id) }}">
                    Onderzoek aanpassen
                </x-button>
            </div>
            <form method="POST" id="deleteForm" action="{{ route('researches.remove', $research->id) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove" link="#" formId="deleteForm">
                    Onderzoek verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs title="researchesDetails" :tabs="['Details', 'Vragenlijsten']" :currentTab="'Details'">
        @section('details')
            <div class="mt-2">
                <strong>Omschrijving</strong>
                <div>
                    {{ $research->description }}
                </div>
            </div>
        @endsection
        @section('vragenlijsten')
            <div class="mt-2">
                <div class="row justify-content-end">
                    <div class="w-auto">
                        <x-button type="secondary" link="{{ route('questionnaires.create', $research->id) }}">
                            Nieuwe vragenlijst
                        </x-button>
                    </div>
                </div>
                <x-table :tableLinks="$questionnaireLinks" :headers="$questionnaireHeaders" :items="$questionnaires" :keys="$questionnaireKeys" :row-link="$questionnaireRowLink"/>
            </div>
        @endsection
    </x-tabs>
@endsection
