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
    <form method="POST" action="{{route('questions.update', [$research->id,$questionnaire->id, $section->id, $question->id])}}">
        @csrf
        @method('PUT')

        <h1 class="title">{{$question->title}} Aanpassen</h1>
        <h2>Gegevens</h2>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" :value="$question->title" required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" :value="$question->question" required></x-input>
            <h2>Antwoordmogelijkheden</h2>
            <span>Nog niet beschikbaar</span>
            <div class="mt-2">
                <x-button type="secondary">Aanpassen</x-button>
            </div>
        </div>
    </form>
@endsection
