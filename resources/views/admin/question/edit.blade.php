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
            <div sort-root class="border border-primary border-top-0 drag-sort-enable">
                @foreach((old('order') ?? $order) as $index => $questionType)
                    @switch($questionType)
                        @case('VOICE')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Spraakopname" name="VOICE" :value="$audioOption != null"></x-input>
                                    <input type="text" name="order[]" value="VOICE" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
                        </div>
                        @break
                        @case('OPEN')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Open antwoord" name="OPEN" :value="$openOption != null"></x-input>
                                    <input type="text" name="order[]" value="OPEN" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
                            <div
                                class="collapse {{is_string(old('OPEN')) ? (old('OPEN') ? 'show' : '') : ($openOption != null ? 'show' : '')}}"
                                id="open-configuration">
                                <div class="hr"></div>
                                <x-input class="col mb-0 mt-1" label="Placeholder" type="text" name="openPlaceholder"
                                         placeholder="Voer placeholder voor open antwoord in"
                                         :value="$openOption && isset($openOption->extra_data['placeholder']) ? $openOption->extra_data['placeholder'] : ''"></x-input>
                            </div>
                        </div>
                        @break
                        @case('MULTIPLE_CHOICE')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Meerkeuze" name="MULTIPLE_CHOICE" :value="false"></x-input>
                                    <input type="text" name="order[]" value="MULTIPLE_CHOICE" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
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
                        @break
                        @case('IMAGE')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Foto" name="IMAGE" :value="$photoOption != null"></x-input>
                                    <input type="text" name="order[]" value="IMAGE" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
                        </div>
                        @break
                        @case('VIDEO')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Video" name="VIDEO" :value="$videoOption != null"></x-input>
                                    <input type="text" name="order[]" value="VIDEO" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
                        </div>
                        @break
                        @case('RANGE')
                        <div sort-item="{{$index}}" class="border-top border-primary p-2">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <x-input class="m-0" type="switch" label="Schaal" name="RANGE" :value="$rangeOption != null"></x-input>
                                    <input type="text" name="order[]" value="RANGE" hidden/>
                                </div>
                                <div class="sortable-icons">
                                    <a up-button href="" {{$index == 0 ? 'hidden' : ''}} title="Vraag type prioriteit hoger sorteren"><i class="bi bi-caret-up-fill"></i></a>
                                    <a down-button href="" {{$index == count($order)-1 ? 'hidden' : ''}} title="Vraag type prioriteit lager sorteren"><i class="bi bi-caret-down-fill pe-auto"></i></a>
                                </div>
                            </div>
                            <div
                                class="collapse {{is_string(old('RANGE')) ? (old('RANGE') ? 'show' : '') : ($rangeOption != null ? 'show' : '')}}"
                                id="range-configuration">
                                <div class="hr"></div>
                                <x-input class="col mb-0 mt-1" label="Minimum" type="number" name="rangeMin"
                                         placeholder="Voer minimum van schaal in"
                                         :value="$rangeOption && isset($rangeOption->extra_data['min']) ? $rangeOption->extra_data['min'] : ''"></x-input>
                                <x-input class="col mb-0 mt-1" label="Maximum" type="number" name="rangeMax"
                                         placeholder="Voer maximum van schaal in"
                                         :value="$rangeOption && isset($rangeOption->extra_data['max']) ? $rangeOption->extra_data['max'] : ''"></x-input>
                                <x-input class="col mb-0 mt-1" label="Stap" type="number" name="rangeStep"
                                         placeholder="Voer de stap in die de schaal moet gebruiken"
                                         :value="$rangeOption && isset($rangeOption->extra_data['step']) ? $rangeOption->extra_data['step'] : ''"></x-input>
                            </div>
                        </div>
                        @break
                    @endswitch
                @endforeach
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
    <script src="{{ asset('js/sortQuestionTypes.js') }}"></script>
@endsection
