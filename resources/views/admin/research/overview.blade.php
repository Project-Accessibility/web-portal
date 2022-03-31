@extends('layouts.app')

@section('content')
    <h1 class="title">Onderzoeken</h1>
    <x-button class="primary-button-align" type="secondary" link="{{ route('researches.create') }}">Nieuw onderzoek</x-button>
    @php
        $headers = ['ID','Titel','Omschrijving'];

        $keys = ['id','title','description'];

        $tableLinks = collect([
            new \App\Utils\TableLink('researches.questionnaires', collect([
                new \App\Utils\TableLinkParameter(routeParameter: 'id',itemIndex: 'id'),
            ]))
        ]);

        $rowLinkParameters = collect([
            new \App\Utils\TableLinkParameter(routeParameter: 'id',itemIndex: 'id'),
        ]);
        $rowLink = new \App\Utils\TableLink('researches.details', $rowLinkParameters);
    @endphp

    <x-table :headers="$headers" :items="$researches" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"/>


@endsection
