@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <h1 class="title col-md-auto">{{$research->title}}</h1>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button class="primary-button-align" type="secondary" link="{{ route('researches.edit', $research->id) }}">
                    Onderzoek aanpassen
                </x-button>
            </div>
            <form method="POST" action="{{ route('researches.remove', $research->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="primary-button-align" type="remove">
                    Onderzoek verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs :tabs="['Details', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Details')
            <div class="col-12">
                <strong>Omschrijving</strong>
                <div class="overflow-scroll border px-2" style="height: 250px">
                    {{ $research->description }}
                </div>
            </div>
            <div class="col-12 mt-2">
                <strong>Omschrijving</strong>
                <div>
                    {{ $research->description }}
                </div>
            </div>
        @endsection
        @section('Vragenlijsten')
        @endsection
    </x-tabs>
@endsection
