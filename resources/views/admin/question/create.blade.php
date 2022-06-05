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
            <div sort-root class="border border-primary border-top-0 drag-sort-enable">
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Spraakopname" name="VOICE" :value="true"></x-input>
                            <input type="number" name="orderVOICE" value="0" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
                </div>
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Open antwoord" name="OPEN" :value="false"></x-input>
                            <input type="number" name="orderOPEN" value="1" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
                    <div class="collapse {{old('OPEN') ? 'show' : ''}}" id="open-configuration">
                        <div class="hr"></div>
                        <x-input class="col mb-0 mt-1" label="Placeholder" type="text" name="openPlaceholder"
                                 placeholder="Voer placeholder voor open antwoord in"></x-input>
                    </div>
                </div>
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Meerkeuze" name="MULTIPLE_CHOICE" :value="false"></x-input>
                            <input type="number" name="orderMULTIPLE_CHOICE" value="2" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
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
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Foto" name="IMAGE" :value="false"></x-input>
                            <input type="number" name="orderIMAGE" value="3" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
                </div>
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Video" name="VIDEO" :value="false"></x-input>
                            <input type="number" name="orderVIDEO" value="4" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
                </div>
                <div sort-item class="border-top border-primary p-2">
                    <div class="row justify-content-between">
                        <div class="col">
                            <x-input class="m-0" type="switch" label="Schaal" name="RANGE" :value="false"></x-input>
                            <input type="number" name="orderRANGE" value="5" hidden/>
                        </div>
                        <div class="sortable-icons">
                            <a up-button href=""><i class="bi bi-caret-up-fill"></i></a>
                            <a down-button href=""><i class="bi bi-caret-down-fill pe-auto"></i></a>
                        </div>
                    </div>
                    <div class="collapse {{old('RANGE') ? 'show' : ''}}" id="range-configuration">
                        <div class="hr"></div>
                        <x-input class="col mb-0 mt-1" label="Minimum" type="number" name="rangeMin"
                                 placeholder="Voer minimum van schaal in"></x-input>
                        <x-input class="col mb-0 mt-1" label="Maximum" type="number" name="rangeMax"
                                 placeholder="Voer maximum van schaal in"></x-input>
                        <x-input class="col mb-0 mt-1" label="Stap" type="number" name="rangeStep"
                                 placeholder="Voer de stap in die de schaal moet gebruiken"
                                 value="1"></x-input>
                    </div>
                </div>
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
    <script src="{{ asset('js/sortQuestionTypes.js') }}"></script>
@endsection
