@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@if($exception)
    @section('message')
        <div class="h2">
            {{__($exception->getMessage() ?: 'Forbidden'}}
        </div>
    @endsection
@endif
