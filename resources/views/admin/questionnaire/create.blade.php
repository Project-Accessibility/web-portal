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
    <form method="POST" action="{{route('questionnaires.store')}}">
        @csrf

        <h1 class="title">Nieuwe vragenlijst</h1>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vragenlijst"></x-input>
            <x-input type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van de vragenlijst" :extraData="['rows'=>8]"></x-input>
            <x-input type="textarea" label="Instructies" name="description"
                     placeholder="De instructies voor de participant in de app" :extraData="['rows'=>8]"></x-input>
            <x-input label="Onderzoek kan worden gebruikt" type="switch" name="switch" :value="false"></x-input>
            <x-input type="text" label="Locatie foto's" name="title" placeholder="Link naar de locatie foto's"></x-input>
            <x-button class="float-end mt-2" type="secondary">Toevoegen</x-button>
        </div>
    </form>
@endsection
