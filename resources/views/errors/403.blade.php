@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@if($exception)
    <div class="h2">
        @section('message',  __($exception->getMessage() ?: 'Forbidden'))
    </div>
@endif
