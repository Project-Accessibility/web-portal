@extends('layouts.app')

@section('content')
    <h1 class="title">Onderdeel {{$section->id}} - Vraag {{$question->id}} - Participant #{{$participant->id}}</h1>
    <h2 class="h2">{{$question->question}}</h2>
    <div class="row">
        @foreach($options as $answers)
            <div class="col-md-6 mt-2">
                <h3 class="h4">{{ $answers[0]->option()->type->display() }}</h3>
                @switch($answers[0]->option()->type)
                    @case(\App\Enums\QuestionOptionType::OPEN)
                    <p>{{$answers[0]->answer['text']}}</p>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VOICE)
                    <div class="row gy-2">
                        @foreach($answers as $answer)
                            <audio  controls>
                                <source src="{{ $answer->answer['link'] }}" type="audio/mpeg">
                            </audio>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::IMAGE)
                    <div class="row gy-2">
                        @foreach($answers as $answer)
                            <a href="#" class="col-md-6" data-bs-toggle="modal"
                               data-bs-target="#previewImage{{$answer->id}}">
                                <img src="{{ $answer->answer['link'] }}" class="w-100 h-100" alt="image">
                            </a>
                            <div class="modal fade" id="previewImage{{$answer->id}}" tabindex="-1"
                                 aria-labelledby="previewImageLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewImageLabel">Afbeelding preview</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $answer->answer['link'] }}" class="w-100" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @break;
                    @case(\App\Enums\QuestionOptionType::VIDEO)
                    <div class="row gy-2">
                        @foreach($answers as $answer)
                            <a href="#" class="col-md-6" data-bs-toggle="modal"
                               data-bs-target="#previewVideo{{$answer->id}}">
                                <video src="{{ $answer->answer['link'] }}" class="w-100"></video>
                                <div class="modal fade" id="previewVideo{{$answer->id}}" tabindex="-1"
                                     aria-labelledby="previewVideoLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="previewVideoLabel">Video preview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <video id="video{{$answer->id}}" src="{{ $answer->answer['link'] }}"
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
                    <div class="row gy-2">
                        <ul class="list-group">
                            @foreach($answers[0]->answer['options'] as $answer)
                                <li class="list-group-item {{in_array($answer, $answers[0]->answer['selected']) ? 'selected' : ''}}">{{ $answer }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @break;
                @endswitch
            </div>
        @endforeach
    </div>
@endsection
