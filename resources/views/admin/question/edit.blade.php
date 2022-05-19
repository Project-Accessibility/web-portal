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
    @php
        $audioOption = null;
        $openOption = null;
        $multipleChoiceOption = null;
        $photoOption = null;
        $videoOption = null;
        $rangeOption = null;
        foreach ($question->options as $option){
            switch ($option->type){
                case \App\Enums\QuestionOptionType::VOICE:
                    $audioOption = $option;
                    break;
                case \App\Enums\QuestionOptionType::OPEN:
                    $openOption = $option;
                break;
                case \App\Enums\QuestionOptionType::MULTIPLE_CHOICE:
                    $multipleChoiceOption = $option;
                    break;
                case \App\Enums\QuestionOptionType::IMAGE:
                    $photoOption = $option;
                    break;
                case \App\Enums\QuestionOptionType::VIDEO:
                    $videoOption = $option;
                    break;
                case \App\Enums\QuestionOptionType::RANGE:
                    $rangeOption = $option;
                    break;
                default:
                    break;
            }
        }
    @endphp
    <form method="POST"
          action="{{route('questions.update', [$research->id,$questionnaire->id, $section->id, $question->id])}}">
        @csrf
        @method('PUT')

        <h1 class="title">{{ $question->title }} aanpassen</h1>
        <div class="col-md-6">
            <h2 class="h2">Gegevens</h2>
            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" :value="$question->title"
                     required></x-input>
            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" :value="$question->question"
                     required></x-input>
            <h2 class="h2">Antwoord mogelijkheden</h2>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Spraakopname" name="VOICE"
                         :value="$audioOption != null"></x-input>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Open antwoord" name="OPEN"
                         :value="$openOption != null"></x-input>
                <div
                    class="collapse {{is_string(old('OPEN')) ? (old('OPEN') ? 'show' : '') : ($openOption != null ? 'show' : '')}}"
                    id="open-configuration">
                    <div class="hr"></div>
                    <x-input class="col mb-0 mt-1" label="Placeholder" type="text" name="openPlaceholder"
                             placeholder="Voer placeholder voor open antwoord in"
                             :value="$openOption && isset($openOption->extra_data['placeholder']) ? $openOption->extra_data['placeholder'] : ''"></x-input>
                </div>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Meerkeuze" name="MULTIPLE_CHOICE"
                         :value="$multipleChoiceOption != null"></x-input>
                <div
                    class="collapse {{is_string(old('MULTIPLE_CHOICE')) ? (old('MULTIPLE_CHOICE') ? 'show' : '') : ($multipleChoiceOption != null ? 'show' : '')}}"
                    id="list-configuration">
                    <div class="hr"></div>
                    <x-input class="small" type="switch" label="Meerdere antwoorden mogelijk" name="multipleAnswers"
                             :value="$multipleChoiceOption != null ? $multipleChoiceOption->extra_data['multiple'] : false"></x-input>
                    <div>
                        <div class="d-flex gap-2 align-items-center">
                            <x-input class="w-100 mb-0 mt-1" type="text" name="listInput"
                                     placeholder="Voer antwoord optie in">
                            </x-input>
                            <div class="mt-1 px-0" style="width: 40px!important;">
                                <x-button class="fw-bold" type="primary" link="#" id="add-list-item-button">+</x-button>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush px-2" id="list">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Foto" name="IMAGE" :value="$photoOption != null"></x-input>
            </div>
            <div class="border border-primary p-2 border-bottom-0">
                <x-input class="m-0" type="switch" label="Video" name="VIDEO"
                         :value="$videoOption != null"></x-input>
            </div>
            <div class="border border-primary p-2">
                <x-input class="m-0" type="switch" label="Schaal" name="RANGE"
                         :value="$rangeOption != null"></x-input>
                <div
                    class="collapse {{is_string(old('RANGE')) ? (old('RANGE') ? 'show' : '') : ($openOption != null ? 'show' : '')}}"
                    id="range-configuration">
                    <div class="hr"></div>
                    <x-input class="col mb-0 mt-1" label="Minimum" type="number" name="rangeMin"
                             placeholder="Voer minimum van schaal in"
                             :value="$rangeOption && isset($rangeOption->extra_data['rangeMin']) ? $rangeOption->extra_data['rangeMin'] : ''"></x-input>
                    <x-input class="col mb-0 mt-1" label="Minimum" type="number" name="rangeMin"
                             placeholder="Voer minimum van schaal in"
                             :value="$rangeOption && isset($rangeOption->extra_data['rangeMin']) ? $rangeOption->extra_data['rangeMin'] : ''"></x-input>
                    <x-input class="col mb-0 mt-1" label="Minimum" type="number" name="rangeMin"
                             placeholder="Voer minimum van schaal in"
                             :value="$rangeOption && isset($rangeOption->extra_data['rangeMin']) ? $rangeOption->extra_data['rangeMin'] : ''"></x-input>
                </div>
            </div>
            @if($questionnaire->open)
                <x-button class="float-end mt-2" type="secondary">Nieuwe versie aanmaken</x-button>
            @else
                <x-button class="float-end mt-2" type="secondary">Aanpassen</x-button>
            @endif
        </div>
    </form>
    <script>
        if (!{{empty(old('MULTIPLE_CHOICE')) ? 1 : 0}}) {
            if (!{{empty(old('list')) ? 1 : 0}}) {
                window.values = {!! json_encode(old('list')) !!};
            }
        } else if (!{{is_null($multipleChoiceOption) ? 1 : 0}}) {
            window.values = {!! json_encode($multipleChoiceOption ? $multipleChoiceOption->extra_data['values'] : []) !!};
        }
    </script>
    <script src="{{ asset('js/questionOptions.js') }}"></script>
@endsection
