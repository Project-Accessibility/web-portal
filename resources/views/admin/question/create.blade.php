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
    <form method="POST" action="{{route('questions.store', [$research->id, $questionnaire->id, $section->id])}}">
        @csrf

        <h1 class="title">Nieuwe vraag</h1>
        <h2>Gegevens</h2>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" required></x-input>
            <h2>Antwoordmogelijkheden</h2>
            <span>Nog niet beschikbaar</span>
            <div class="mt-2">
                <x-button type="secondary">Toevoegen</x-button>
            </div>
        </div>
    </form>
@endsection
