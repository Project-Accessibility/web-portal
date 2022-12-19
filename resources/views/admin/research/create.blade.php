@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Er waren wat problemen met uw data</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{route('researches.store')}}">
        @csrf

        <h1 class="title">Nieuw onderzoek</h1>
        <div class="col-md-6">
            @if(! empty($templateExtraData['options']))
                <div class="mb-5">
                    <x-input class="mb-1" label="Op basis van onderzoek" type="select" name="template" :extraData="$templateExtraData"></x-input>
                    <span class="small fst-italic">Bij het selecteren van een onderzoek worden de vraenlijsten, onderdelen en vragen gekopieerd vanuit het geselecteerde onderzoek.</span>
                </div>
            @endif
            <x-input required type="text" label="Titel" name="title" placeholder="Titel van het onderzoek"></x-input>
            <x-input type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van het onderzoek" :extraData="['rows'=>8]"></x-input>
            <x-button class="float-end mt-2" type="secondary">Toevoegen</x-button>
        </div>
    </form>
@endsection
