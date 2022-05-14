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
    <form method="POST" action="{{route('sections.store', [$research->id, $questionnaire->id])}}">
        @csrf

        <h1 class="title">Nieuwe Onderdeel</h1>
        <h2>Gegevens</h2>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van het onderdeel" required></x-input>
            <x-input  type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van het onderdeel" :extraData="['rows'=>8]"></x-input>
            <x-input  type="textarea" label="Locatie omschrijving" name="location_description"
                     placeholder="Een kleine omschrijving van de locatie" :extraData="['rows'=>8]"></x-input>
        </div>
        <h2>Geofence</h2>
        <div class="row">
            <div class="col-md-6">
                <x-input type="number" label="Radius" name="radius" placeholder="Voer radius in" value="30" :extraData="['after' => 'm']"></x-input>
                <x-input type="text" label="Latitude" name="latitude"></x-input>
                <x-input type="text" label="Longitude" name="longitude"></x-input>
                <input type="text" name="test" value="{{env('MAPBOX_ACCESS_TOKEN')}}" hidden/>
            </div>
            <div class="col-md-6" style="min-height: 200px;">
                <div id="map" data-editable="true" class="h-100 border border-primary"></div>
            </div>
        </div>
        <div class="mt-2 col-md-6">
            <x-button id="location-button" class="float-start" type="primary" link="#">Locatie ophalen</x-button>
            <x-button class="float-end" type="secondary">Toevoegen</x-button>
        </div>
    </form>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
    <script>mapboxgl.accessToken = 'pk.eyJ1IjoibWlsb3ZkcGFzIiwiYSI6ImNsMW5veGNtcjByaXozYnFycmdlOW1mY2gifQ.XlD67O_pB2Q-ULGzQ_HQOw';</script>
    <script src="{{ asset('js/location.js') }}"></script>
@endsection
