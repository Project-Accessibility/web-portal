@extends('layouts.app')

@section('content')
    <h1 class="title">{{$research->title}}</h1>
    <form method="POST" action="{{ route('researches.remove', $research->id) }}">
        @csrf
        @method('DELETE')
        <x-button class="primary-button-align" type="remove">
            Onderzoek verwijderen
        </x-button>
    </form>
    <x-button class="primary-button-align mx-2" type="secondary" link="{{ route('researches.edit', $research->id) }}">
        Onderzoek aanpassen
    </x-button>
    <x-tabs :tabs="['Details', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Details')
            <div class="w-50">
                <div class="form-group">
                    <label for="description" class="form-label">Omschrijving</label>
                    <textarea class="form-control" rows="8" disabled>{{$research->description}}</textarea>
                </div>
            </div>
        @endsection
        @section('Vragenlijsten')
        @endsection
    </x-tabs>
@endsection
