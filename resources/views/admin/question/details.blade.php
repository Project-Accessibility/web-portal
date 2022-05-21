@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                {{$question->title}}
            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button type="secondary"
                          link="{{ route('questions.edit', [$research->id,$questionnaire->id, $section->id, $question->id]) }}">
                    Vraag aanpassen
                </x-button>
            </div>
            <form method="POST"
                    id="deleteForm"
                  action="{{ route('questions.remove', [$research->id, $questionnaire->id, $section->id, $question->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove" link="#" formId="deleteForm">
                    Vraag verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Gegevens</h2>
            <div class="col-sm-6">
                <strong>Vraag</strong>
                <div>
                    {{ $question->question }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Antwoordmogelijkheden</h2>
            <div class="accordion" id="questionOptions">
                @if(count($questionOptions) > 0)
                    @foreach($questionOptions as $questionOption)
                        <div class="accordion-item">
                            @if(isset($questionOption->extra_data) && count($questionOption->extra_data) > 0)
                                <span class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapseOne">
                                        {{ $questionOption->type->display() }}
                                    </button>
                                </span>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#questionOptions">
                                    <div class="accordion-body">
                                        @foreach($questionOption->extra_data as $key => $extraData)
                                            <strong>{{ ucfirst(__('question-types.'. $key)) }}: </strong>
                                            @if(is_array($extraData))
                                                <ul>
                                                    @foreach($extraData as $extraDataItem)
                                                        <li>{{ $extraDataItem }}</li>
                                                    @endforeach
                                                </ul>
                                            @elseif($questionOption->type === \App\Enums\QuestionOptionType::RANGE)
                                                <span>{{ $extraData }}</span>
                                            @else
                                                <span>{{ $extraData === '1' ? 'Ja' : ($extraData === '0' ? 'Nee' : $extraData) }}</span>
                                            @endif
                                            <br />
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <span class="accordion-header" id="headingOne">
                                    <button disabled class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $questionOption->type->display() }}
                                    </button>
                                </span>
                            @endif
                        </div>
                    @endforeach
                @else
                    <span>Er zijn voor deze vraag nog geen antwoordmogelijkheden geselecteerd.</span>
                @endif
            </div>
        </div>
    </div>
@endsection
