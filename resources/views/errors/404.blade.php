@extends('errors.minimal')

@section('title', 'Niet gevonden')
@section('code', '404')
@section('header', 'Pagina niet gevonden')
@section('message', $message ?? 'URL bestaat niet')
