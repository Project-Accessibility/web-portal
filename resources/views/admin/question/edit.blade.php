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

        <h1 class="title">Nieuwe vraag</h1>
        <div class="col-md-6">
            <h2 class="h2">Gegevens</h2>
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" :value="$question->title"
                     required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" :value="$question->question"
                     required></x-input>
            <h2 class="h2">Antwoord mogelijkheden</h2>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Open antwoord" name="openAnswer" :value="false"></x-input>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Meerkeuze" name="multipleChoice"
                         :value="$question->options[0]->type == 'multipleChoice'"></x-input>
                <div class="collapse {{$question->options[0]->type == 'multipleChoice' ? 'show' : ''}}"
                     id="list-configuration">
                    <div class="hr"></div>
                    <x-input class="small" type="switch" label="Meerdere antwoorden mogelijk" name="multipleAnswers"
                             :value="$question->options[0]->extra_data->multiple"></x-input>
                    <div class="row">
                        <x-input class="col mb-0 mt-1" required type="text" name="listInput"
                                 placeholder="Voer antwoord optie in"></x-input>
                        <div class="col-md-2 mt-1 px-0 me-3" style="width: 40px!important;">
                            <x-button class="fw-bold w-100" type="primary" link="#" id="add-list-item-button">+
                            </x-button>
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
                <x-input class="m-0" type="switch" label="Spraakopname" name="audio" :value="true"></x-input>
            </div>
            <div class="mt-2">
                <x-button type="secondary">Aanpassen</x-button>
            </div>
            <x-button class="float-end mt-2" type="secondary">Aanpassen</x-button>
        </div>
    </form>
    <script>
        if ({{$question->options[0]->type == 'multipleChoice'}}) {
            window.values = {!! json_encode($question->options[0]->extra_data->values) !!};
        }
    </script>
    <script src="{{ asset('js/select.js') }}"></script>
@endsection
