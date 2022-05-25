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
                        @foreach($answer->values as $link)
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
                        @foreach($answer->values as $link)
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
                        @foreach($answer->option->extra_data['values'] as $option)
                            <li class="list-group-item {{in_array($option, $answer->values) ? 'selected' : ''}}" {{in_array($option, $answer->values) ? 'aria-selected=true' : 'aria-selected=false'}}>
                                @if(in_array($option, $answer->values))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" stroke-width="1" stroke="white">
                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg>
                                @endif
                                {{ $option }}</li>
                        @endforeach
                    </ul>
                    @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
