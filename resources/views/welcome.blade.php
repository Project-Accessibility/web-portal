@extends('layouts.app')

@section('content')
    <h1 class="title">Home pagina</h1>
    <x-button type="secondary" link="{{ route('stylesheet') }}">Stylesheet</x-button>
    <x-button type="secondary" link="{{ route('inputs') }}">Inputs testen</x-button>
@endsection
