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
            <form method="POST" action="{{ route('researches.remove', $research->id) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove">
                    Onderzoek verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs title="researchesDetails" :tabs="['Details', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Details')
            <div class="col-12 mt-2">
                <strong>Omschrijving</strong>
                <div>
                    {{ $research->description }}
                </div>
            </div>
        @endsection
        @section('Vragenlijsten')
            <p>Test</p>
        @endsection
    </x-tabs>
@endsection
