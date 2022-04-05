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
    <form method="POST" action="{{route('questionnaires.store', $researchId)}}">
        @csrf

        <h1 class="title">Nieuwe vragenlijst</h1>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vragenlijst"></x-input>
            <x-input required="0" type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van de vragenlijst" :extraData="['rows'=>8]"></x-input>
            <x-input required="0" type="textarea" label="Instructies" name="instructions"
                     placeholder="De instructies voor de participant in de app" :extraData="['rows'=>8]"></x-input>
            <x-input required="0" label="Onderzoek kan worden gebruikt" type="switch" name="open" :value="false"></x-input>
            <fieldset disabled>
                <x-input required="0" type="text" label="Locatie foto's" name="teachable_machine_link" placeholder="Link naar de locatie foto's"></x-input>
            </fieldset>
            <x-button class="float-end mt-2" type="secondary">Toevoegen</x-button>
        </div>
    </form>
@endsection