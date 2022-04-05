@extends('layouts.app')

@section('content')

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                {{$section->title}}
            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <x-button type="secondary" link="{{ route('sections.edit', [$section->questionnaire()->research(),$section->questionnaire(), $questionnaire]) }}">
                    Onderdeel aanpassen
                </x-button>
            </div>
            <form method="POST" action="{{ route('sections.remove', [$section->questionnaireId, $section->id]) }}">
                @csrf
                @method('DELETE')
                <x-button type="remove">
                    Onderdeel verwijderen
                </x-button>
            </form>
        </div>
    </div>
    <x-tabs title="sectionDetails" :tabs="['Details', 'Resultaten']">
        @section('Details')
            <div class="row mt-2">
                <div class="col-sm-6">
                    <strong>Omschrijving</strong>
                    <div>
                        {{ $section->description }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <strong>Locatie omschrijving</strong>
                    <div>
                        {{ $section->location_description }}
                    </div>
                </div>
            </div>
        @endsection
        @section('Resultaten')
        @endsection
    </x-tabs>
@endsection
