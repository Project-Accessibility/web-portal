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
    <form method="POST" action="{{route('geofence.store')}}">
        @csrf

        <h1 class="title">Geofence toevoegen</h1>
        <div class="row">
            <div class="col-md-6 same-height">
                <x-input type="number" label="Radius" name="radius" placeholder="Voer radius in" value="30"></x-input>
                <x-input type="text" label="Latitude" name="latitude"></x-input>
                <x-input type="text" label="Longitude" name="longitude"></x-input>
            </div>
            <div class="col-md-6" style="min-height: 200px;">
                <div id="map" class="h-100 border border-primary"></div>
            </div>
        </div>
        <div class="mt-2">
            <x-button id="location-button" class="float-start" type="primary" link="#">Locatie ophalen</x-button>
            <x-button class="float-end" type="secondary">Toevoegen</x-button>
        </div>
    </form>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJXWDGn6xOjKEzgoLdVElpbVGcPZcwwtw&callback=initMap&libraries=&v=weekly"
        async
    ></script>
    <script src="{{ asset('js/location.js') }}"></script>
@endsection
