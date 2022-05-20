@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@if($message)
    @section('message')
        <div class="h2">
            {{$message}}
        </div>
    @endsection
@endif
