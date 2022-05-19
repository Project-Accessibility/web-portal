@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@if($message)
    <div class="h2">
        @section('message', $message)
    </div>
@endif
