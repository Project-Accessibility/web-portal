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
        <div class="col-md-6">
            <h2 class="h2">Gegevens</h2>
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" required></x-input>
            <h2 class="h2">Antwoord mogelijkheden</h2>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Spraakopname" name="VOICE" :value="true"></x-input>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Open antwoord" name="OPEN" :value="false"></x-input>
                <div class="collapse {{old('OPEN') ? 'show' : ''}}" id="open-configuration">
                    <div class="hr"></div>
                    <x-input class="col mb-0 mt-1" label="Placeholder" type="text" name="openPlaceholder"
                             placeholder="Voer placeholder voor open antwoord in"></x-input>
                </div>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Meerkeuze" name="MULTIPLE_CHOICE" :value="false"></x-input>
                <div class="collapse {{old('MULTIPLE_CHOICE') ? 'show' : ''}}" id="list-configuration">
                    <div class="hr"></div>
                    <x-input class="small" type="switch" label="Meerdere antwoorden mogelijk" name="multipleAnswers"
                             :value="false"></x-input>
                    <div>
                        <div class="d-flex gap-2 align-items-center">
                            <x-input class="w-100 mb-0 mt-1" type="text" name="listInput"
                                     placeholder="Voer antwoord optie in"></x-input>
                            <div class="mt-1 px-0">
                                <x-button class="fw-bold" type="primary" link="#" id="add-list-item-button">+</x-button>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush px-2" id="list">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Foto" name="IMAGE" :value="false"></x-input>
            </div>
            <div class="border border-primary p-2 border">
                <x-input class="m-0" type="switch" label="Video" name="VIDEO" :value="false"></x-input>
            </div>
            <x-button class="float-end mt-2" type="secondary">Toevoegen</x-button>
        </div>
    </form>
    <script>
        if ({{(old('MULTIPLE_CHOICE') && old('list')) ? 1 : 0}}) {
            window.values = {!! json_encode(old('list')) !!};
        }
    </script>
    <script src="{{ asset('js/questionOptions.js') }}"></script>
@endsection
