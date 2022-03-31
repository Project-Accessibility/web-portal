@extends('layouts.app')

@section('content')
    <h1 class="title">Onderzoeken</h1>
    <x-button type="secondary" link="{{ route('stylesheet') }}">Stylesheet</x-button>
    <x-tabs title="tabTitle" :tabs="['Tests', 'Vragenlijsten']" :currentTab="'Details'">
        @section('Tests')
            Tests
            @php
                $extraData=array(
                    'multiple' => false,
                );
            @endphp
            <x-input label="test" type="file" name="image" :extraData="$extraData"></x-input>
            @php
                $extraData=array(
                'before' => '$',
                'after' => '.00'
                );
            @endphp
            <x-input label="test" type="text" name="text" placeholder="input" :extraData="$extraData"></x-input>
            <x-input label="test" type="password" name="password" placeholder="input"></x-input>
            @php
                $extraData=array(
                    'multiple' => false,
                    'options' => [
                      ['option_1', 'value_1'],
                      ['option_2', 'value_2'],
                    ]
                );
            @endphp
            <x-input label="test" type="select" name="selectList" :extraData="$extraData" value="waarde2"></x-input>
            <x-input label="test" type="date" name="datum" value="2021-03-21"></x-input>
            <x-input label="test" type="switch" name="switch" :value="true"></x-input>
            @php
                $extraData=array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.5
                );
            @endphp
            <x-input label="test" type="range" name="range" :extraData="$extraData" :value="1.5"></x-input>

        @endsection
        @section('Vragenlijsten')
            Vragenlijsten
        @endsection
    </x-tabs>
@endsection
