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
                <x-button type="secondary"
                          link="{{ route('sections.edit', [$research->id,$questionnaire->id, $section->id]) }}">
                    Onderdeel aanpassen
                </x-button>
            </div>
            <form method="POST"
                  action="{{ route('sections.remove', [$research->id, $questionnaire->id, $section->id]) }}">
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
                <h2>Gegevens</h2>
                <div class="col-sm-6">
                    <strong>Omschrijving</strong>
                    <div>
                        {{ $section->description ?? 'Geen onderdeel omschrijving'}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <strong>Locatie omschrijving</strong>
                    <div>
                        {{ $section->location_description ?? 'Geen locatie omschrijving'}}
                    </div>
                </div>
            </div>
            <div class="row" id="geofence-section" hidden>
                <h2>Geofence</h2>
                <input id="radius" value="{{$geofence ? $geofence->radius : 30}}" hidden/>
                <input id="latitude" value="{{$geofence ? $geofence->latitude : ''}}" hidden/>
                <input id="longitude" value="{{$geofence ? $geofence->longitude : ''}}" hidden/>
                <div id="map" class="h-100 border border-primary" style="min-height: 200px;"></div>
            </div>
            <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
            <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
            <script>mapboxgl.accessToken = '{{env('MAPBOX_ACCESS_TOKEN')}}';</script>
            <script src="{{ asset('js/location.js') }}"></script>
        @endsection
        @section('Resultaten')
        @endsection
    </x-tabs>
@endsection
