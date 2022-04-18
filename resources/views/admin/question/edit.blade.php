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
            $openAnswerOption= null;
            $multipleChoiceOption = null;
            $photoOption = null;
            $audioOption = null;
            foreach ($question->options as $option){
                switch ($option->type){
                    case \App\Enums\QuestionOptionType::OPEN:
                        $openOption = $option;
                    break;
                    case \App\Enums\QuestionOptionType::MULTIPLE_CHOICE:
                        $multipleChoiceOption = $option;
                        break;
                    case \App\Enums\QuestionOptionType::IMAGE:
                        $photoOption = $option;
                        break;
                    case \App\Enums\QuestionOptionType::VOICE:
                        $audioOption = $option;
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

            <h1 class="title">Nieuwe vraag</h1>
            <div class="col-md-6">
                <h2 class="h2">Gegevens</h2>
                            <x-input type="text" label="Titel" name="title" placeholder="Titel van de vraag" :value="$question->title"
                                     required></x-input>
                            <x-input type="text" label="Vraag" name="question" placeholder="De vraag" :value="$question->question"
                                     required></x-input>
                            <h2 class="h2">Antwoord mogelijkheden</h2>
                            <div class="border border-primary p-2 border-bottom-0">
                                <x-input class="m-0" type="switch" label="Open antwoord" name="open" :value="$openOption != null"></x-input>
                                <div class="collapse {{is_string(old('open')) ? (old('open') ? 'show' : '') : ($openOption != null ? 'show' : '')}}" id="open-configuration">
                                    <div class="hr"></div>
                                    <x-input class="col mb-0 mt-1" label="Placeholder" type="text" name="openPlaceholder"
                                             placeholder="Voer placeholder voor open antwoord in" :value="$openOption ? $openOption->extra_data['placeholder'] : ''"></x-input>
                                </div>
                            </div>
                            <div class="border border-primary p-2 border-bottom-0">
                                <x-input class="m-0" type="switch" label="Meerkeuze" name="multipleChoice"
                                         :value="$multipleChoiceOption != null"></x-input>
                                <div
                                        class="collapse {{is_string(old('multipleChoice')) ? (old('multipleChoice') ? 'show' : '') : ($multipleChoiceOption != null ? 'show' : '')}}"
                                        id="list-configuration">
                                    <div class="hr"></div>
                                    <x-input class="small" type="switch" label="Meerdere antwoorden mogelijk" name="multipleAnswers"
                                             :value="$multipleChoiceOption != null ? $multipleChoiceOption->extra_data['multiple'] : false"></x-input>
                                    <div class="row">
                                        <x-input class="col mb-0 mt-1" type="text" name="listInput"
                                            placeholder="Voer antwoord optie in">
                                        </x-input>
                                        <div class="col-md-2 mt-1 px-0 me-3" style="width: 40px!important;">
                                            <x-button class="fw-bold w-100" type="primary" link="#" id="add-list-item-button">
                                                +
                                            </x-button>
                                        </div>
                                        <ul class="list-group list-group-flush px-2" id="list">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-primary p-2 border-bottom-0">
                                <x-input class="m-0" type="switch" label="Foto" name="photo" :value="$photoOption != null"></x-input>
                            </div>
                            <div class="border border-primary p-2">
                                <x-input class="m-0" type="switch" label="Spraakopname" name="audio"
                                         :value="$audioOption != null"></x-input>
                            </div>
                            <x-button class="float-end mt-2" type="secondary">Aanpassen</x-button>
                        </div>
        </form>
        <script>
        if (!{{empty(old('multipleChoice')) ? 1 : 0}}) {
        if (!{{empty(old('list')) ? 1 : 0}}) {
        window.values = {!! json_encode(old('list')) !!};
        }
        } else if (!{{is_null($multipleChoiceOption) ? 1 : 0}}) {
        window.values = {!! json_encode($multipleChoiceOption ? $multipleChoiceOption->extra_data['values'] : []) !!};
        }
        </script>
        <script src="{{ asset('js/questionOptions.js') }}"></script>
@endsection
