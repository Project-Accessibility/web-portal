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
    <form method="POST" action="">
        @csrf

        <h1 class="title">Nieuwe vraag</h1>
        <div class="col-md-6">
            <h2 class="h2">Gegevens</h2>
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" required></x-input>
            <h2 class="h2">Antwoord mogelijkheden</h2>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Open antwoord" name="openAnswer" :value="true"></x-input>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Meerkeuze" name="multipleChoice" :value="false"></x-input>
                <div class="collapse" id="list-configuration">
                    <div class="hr"></div>
                    <x-input class="small" type="switch" label="Meerdere antwoorden mogelijk" name="multipleAnswers"
                             :value="false"></x-input>
                    <div class="row">
                        <x-input class="col mb-0 mt-1" required type="text" name="listInput"
                                 placeholder="Antwoord 1"></x-input>
                        <div class="col-md-2 mt-1" style="width: 80px!important;">
                            <x-button class="fw-bold w-100" type="primary" link="#" id="add-list-item-button">+</x-button>
                        </div>
                        <ul class="list-group list-group-flush px-2" id="list">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Foto" name="photo" :value="false"></x-input>
            </div>
            <div class="border border-primary p-2">
                <fieldset disabled="disabled">
                    <x-input class="m-0" type="switch" label="Spraakopname" name="audio" :value="true"></x-input>
                </fieldset>
            </div>
            <div class="mt-2">
                <x-button type="secondary">Toevoegen</x-button>
            </div>
            <x-button class="float-end mt-2" type="secondary">Toevoegen</x-button>
        </div>
    </form>
    <script src="{{ asset('js/select.js') }}"></script>
@endsection
