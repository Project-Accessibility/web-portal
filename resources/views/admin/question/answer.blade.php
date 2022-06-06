@extends('layouts.app')

@section('content')
    <h1 class="title">Onderdeel {{$section->id}} - Vraag {{$question->id}} - Participant #{{$participant->code}}</h1>
    <div class="col-md-auto d-flex align-items-center gap-2">
        <h2 class="h2">{{$question->question}}</h2>
        <span>
            @if($question->latestVersion() == $question->version)
                <span class="badge rounded-pill bg-secondary">Laatste versie</span>
            @else
                <span class="badge rounded-pill bg-secondary">Versie {{$question->version}}</span>
            @endif
        </span>
    </div>
    <hr/>
    <div class="row">
        @foreach($answers as $answer)
            <div class="mt-2">
                <h3 class="h4">{{ $answer->option->type->display() }}</h3>
                @switch($answer->option->type)
                    @case(\App\Enums\QuestionOptionType::OPEN)
                    <p>{{$answer->values[0]}}</p>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VOICE)
                    <div class="row gy-2">
                        @foreach($answer->values as $link)
                            <audio controls>
                                <source src="{{ $link }}" type="audio/mpeg">
                            </audio>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::IMAGE)
                    <div class="row gy-2">
                        <section id="gallery">
                            <section id="images">
                                <div class="row">
                                    @foreach($answer->values as $link)
                                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                            <a href="#" data-bs-toggle="modal"
                                               data-bs-target="#previewImage{{$loop->index}}">
                                                <img src="{{ $link }}"
                                                     class="fit-cover" alt="image{{$loop->index}}"/>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                            <section id="modals">
                                @foreach($answer->values as $link)
                                    <div
                                        class="modal fade"
                                        id="previewImage{{$loop->index}}"
                                        tabindex="-1"
                                        aria-labelledby="afbeelding {{$loop->index}} popup"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog modal-dialog-centered p-0">
                                            <div class="modal-content p-3">
                                                <img class="fit-contain" src="{{ $link }}" alt="image{{$loop->index}}"/>

                                                <div class="text-center pt-3">
                                                    <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">
                                                        Sluiten
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </section>
                        </section>
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VIDEO)
                    <section id="gallery">
                        <section id="thumbnails">
                            <div class="row">
                                @foreach($answer->values as $link)
                                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                        <a href="#" class="d-flex justify-content-center align-items-center"
                                           data-bs-toggle="modal"
                                           data-bs-target="#previewVideo{{$loop->index}}">
                                            <video src="{{ $link }}"
                                                   class="fit-cover"></video>
                                            <i class="bi bi-play position-absolute text-white h1"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <section id="modals">
                            @foreach($answer->values as $link)
                                <div
                                    class="modal fade"
                                    id="previewVideo{{$loop->index}}"
                                    tabindex="-1"
                                    aria-labelledby="video {{$loop->index}} popup"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content p-3">
                                            <video class="fit-contain" id="video{{$loop->index}}" src="{{ $link }}"
                                                   controls></video>

                                            <div class="text-center pt-3">
                                                <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                    Sluiten
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    const modal = document.getElementById('previewVideo{{$loop->index}}');
                                    const video = document.getElementById('video{{$loop->index}}');
                                    modal.addEventListener('hide.bs.modal', function () {
                                        video.load();
                                    });
                                </script>
                            @endforeach
                        </section>
                    </section>
                    @break;
                    @case(\App\Enums\QuestionOptionType::MULTIPLE_CHOICE)
                    <ul class="list-group">
                        @foreach($answer->option->extra_data['values'] as $option)
                            <li class="list-group-item {{in_array($option, $answer->values) ? 'selected' : ''}}" {{in_array($option, $answer->values) ? 'aria-selected=true' : 'aria-selected=false'}}>
                                @if(in_array($option, $answer->values))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         viewBox="0 0 16 16" stroke-width="1" stroke="white">
                                        <path
                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                        <path
                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg>
                                @endif
                                {{ $option }}</li>
                        @endforeach
                    </ul>
                    @break;
                    @case(\App\Enums\QuestionOptionType::RANGE)
                    <x-input type="range" name="range" :extraData="$answer->option->extra_data->toArray()"
                             :value="$answer->values[0]" :disabled="true"></x-input>
                    @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
