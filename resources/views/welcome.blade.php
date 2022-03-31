@extends('layouts.app')

@section('content')
    <h1 class="title">Onderzoeken</h1>
    <x-button class="primary-button-align" type="secondary" link="{{ route('stylesheet') }}">Stylesheet</x-button>
    <x-tabs :tabs="['Tests', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Tests')
            Tests
            @php
                $extraData=array(
                    'multiple' => false,
                );
            @endphp
            <x-input type="file" label="Image" name="image" :extraData="$extraData"></x-input>
            @php
                $extraData=array(
                'before' => '$',
                'after' => '.00'
                );
            @endphp
            <x-input type="text" label="Text" name="text" placeholder="input" :extraData="$extraData"></x-input>
            <x-input type="password" label="Password" name="password" placeholder="input"></x-input>
            @php
                $extraData=array(
                    'multiple' => false,
                    'options' => [
                      ['option_1', 'value_1'],
                      ['option_2', 'value_2'],
                    ]
                );
            @endphp
            <x-input type="select" label="Lijst" name="select" :extraData="$extraData" value="waarde2"></x-input>
            <x-input type="date" label="Datum" name="date" value="2021-03-21"></x-input>
            <x-input type="switch" label="Switch" name="switch" :value="true"></x-input>
            @php
                $extraData=array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.5
                );
            @endphp
            <x-input type="range" label="Range" name="range" :extraData="$extraData" :value="1.5"></x-input>

        @endsection
        @section('Vragenlijsten')
            Vragenlijsten
        @endsection
    </x-tabs>
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
