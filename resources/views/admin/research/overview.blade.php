@extends('layouts.app')

@section('content')
    <div class="row align-items-center justify-content-between">
        <h1 class="title col-auto">Onderzoeken</h1>
        <div class="col-auto">
            <x-button type="secondary" link="{{ route('researches.create') }}">Nieuw onderzoek</x-button>
        </div>
    </div>
    @php
        $headers = ['ID','Titel','Omschrijving'];

        $keys = ['id','title','description'];

        $tableLinks = collect([
            new \App\Utils\TableLink('researches.questionnaires', collect([
                new \App\Utils\TableLinkParameter(routeParameter: 'research',itemIndex: 'id'),
            ]))
        ]);

        $rowLinkParameters = collect([
            new \App\Utils\TableLinkParameter(routeParameter: 'research', itemIndex: 'id'),
        ]);
        $rowLink = new \App\Utils\TableLink('researches.details', $rowLinkParameters);
    @endphp

    <x-table :headers="$headers" :items="$researches" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"/>


@endsection
