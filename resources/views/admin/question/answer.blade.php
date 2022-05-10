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
                <h3 class="h4">{{ $answer->option()->type->display() }}</h3>
                @switch($answer->option()->type)
                    @case(\App\Enums\QuestionOptionType::OPEN)
                    <p>{{$answer->answer[0]}}</p>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VOICE)
                    <div class="row gy-2">
                        @foreach($answer->answer as $link)
                            <audio controls>
                                <source src="{{ $link }}" type="audio/mpeg">
                            </audio>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::IMAGE)
                    <div class="row gy-2">
                        @foreach($answer->answer as $link)
                            <a href="#" class="col-lg-4 col-md-6" data-bs-toggle="modal"
                               data-bs-target="#previewImage{{$loop->index}}">
                                <img src="{{ $link }}" class="fit-image-cover" alt="image">
                            </a>
                            <div class="modal fade" id="previewImage{{$loop->index}}" tabindex="-1"
                                 aria-labelledby="previewImageLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewImageLabel">Volledige grootte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $link }}" class="w-100" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VIDEO)
                    <div class="row gy-2">
                        @foreach($answer->answer as $link)
                            <a href="#" class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center"
                               data-bs-toggle="modal"
                               data-bs-target="#previewVideo{{$loop->index}}">
                                <video src="{{ $link }}" class="w-100"></video>
                                <i class="bi bi-play position-absolute text-white h1"></i>
                                <div class="modal fade" id="previewVideo{{$loop->index}}" tabindex="-1"
                                     aria-labelledby="previewVideoLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="previewVideoLabel">Volledige grootte</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <video id="video{{$answer->id}}" src="{{ $link }}"
                                                       class="w-100 h-100" controls></video>
                                            </div>
                                            <script>
                                                const modal = document.getElementById('previewVideo' + '{{$answer->id}}');
                                                const video = document.getElementById('video' + '{{$answer->id}}');
                                                modal.addEventListener('hide.bs.modal', function () {
                                                    video.pause();
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::MULTIPLE_CHOICE)
                    <ul class="list-group">
                        @foreach($answer->option()->extra_data['values'] as $option)
                            <li class="list-group-item {{in_array($option, $answer->answer) ? 'selected' : ''}}" {{in_array($option, $answer->answer) ? 'aria-selected=true' : 'aria-selected=false'}}>{{ $option }}</li>
                        @endforeach
                    </ul>
                    @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
