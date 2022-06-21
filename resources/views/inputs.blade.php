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
    <form method="POST" action="{{route('inputs.store')}}">
        @csrf

        <h1 class="title">Inputs testen</h1>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van het onderzoek"></x-input>
            <x-input type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van het onderzoek" :extraData="['rows'=>8]"></x-input>
            @php
                $extraData=array(
                'before' => '$',
                'after' => '.00'
                );
            @endphp
            <x-input label="Geld" type="number" name="money" placeholder="input" :extraData="$extraData"></x-input>
            @php
                $extraData=array(
                    'multiple' => false,
                );
            @endphp
            <x-input label="File" type="file" name="image" :extraData="$extraData"></x-input>
            <x-input label="Wachtwoord" type="password" name="password" placeholder="input"></x-input>
            @php
                $extraData=array(
                    'multiple' => true,
                    'options' => [
                      ['option_1', 'value_1'],
                      ['option_2', 'value_2'],
                    ]
                );
            @endphp
            <x-input label="Lijst" type="select" name="selectList" :extraData="$extraData" :value="['value_2']"></x-input>
            <x-input label="Datum" type="date" name="datum" value="2021-03-21"></x-input>
            <x-input label="Instelling 1" type="switch" name="switch" :value="true"></x-input>
            @php
                $extraData=array(
                    'min' => 0,
                    'max' => 5,
                    'step' => 0.5
                );
            @endphp
            <x-input label="Chips rating" type="range" name="range" :extraData="$extraData" :value="1.5"></x-input>
            <x-button class="float-end mt-2" type="secondary">Testen</x-button>
        </div>
    </form>
@endsection
