@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Er waren wat problemen met uw data</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('researches.store')}}">
        @csrf

        <h1 class="title">Nieuw onderzoek</h1>
        <div class="w-50">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van het onderzoek"></x-input>
            <x-input type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van het onderzoek" :extraData="['rows'=>8]"></x-input>
            <x-button class="float-end mt-3" type="secondary">Toevoegen</x-button>
        </div>
    </form>
@endsection
