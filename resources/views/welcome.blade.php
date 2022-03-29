@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="box container bg-white p-4">
            <h1>Accessibility questionnaire dashboard</h1>
            <p class="lead">Deze pagina is nog niet in gebruik</p>
            <x-button class="mx-4" type="" link="{{ route('stylesheet') }}">Stylesheet is hier te vinden.</x-button>
        </div>
    </div>
    <h1>Welcome to this page</h1>
    <x-tabs :tabs="['Details', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Details')
            Details
        @endsection
        @section('Vragenlijsten')
            Vragenlijsten
        @endsection
    </x-tabs>
@endsection
