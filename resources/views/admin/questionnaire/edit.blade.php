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
    <form method="POST" action="{{route('questionnaires.update', [$research, $questionnaire])}}">
        @csrf
        @method('PUT')

        <h1 class="title">{{$questionnaire->title}} Aanpassen</h1>
        <div class="col-md-6">
            <x-input required type="text" label="Titel" name="title" placeholder="Titel van de vragenlijst" :value="$questionnaire->title" required></x-input>
            <x-input  type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van de vragenlijst" :extraData="['rows'=>8]" :value="$questionnaire->description"></x-input>
            <x-input type="textarea" label="Instructies" name="instructions"
                     placeholder="De instructies voor de participant in de app" :extraData="['rows'=>8]" :value="$questionnaire->instructions"></x-input>
            <x-input type="textarea" label="Helppagina tekst" name="help"
                     placeholder="Tekst voor de helppagina specifiek voor deze vragenlijst" :extraData="['rows'=>8]" :value="$questionnaire->help"></x-input>
            <x-input label="Onderzoek kan worden gebruikt" type="switch" name="open" :value="false" :value="$questionnaire->open"></x-input>
            <x-button class="float-end mt-2" type="secondary">Aanpassen</x-button>
        </div>
    </form>
@endsection
