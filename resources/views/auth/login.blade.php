@extends('layouts.default')

@section('content')
    <div class="col-md-4 mx-auto mt-5">
        @if(session()->has('unauth'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>U moet ingelogd zijn.</strong><br><br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="p-3 bg-white">
            <h1>Inloggen</h1>
            <hr />
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
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-input type="email" label="E-mail" name="email" placeholder="Uw e-mail"></x-input>
                <x-input type="password" label="Wachtwoord" name="password" placeholder="Uw wachtwoord"></x-input>

                <div class="d-flex justify-content-between">
                    <x-input label="Onthoud mij" type="switch" name="remember_me" :value="true"></x-input>
                    <label class="form-label">
                        <a href="{{ route('password.request') }}" class="float-right small">{{__('Wachtwoord vergeten?')}}</a>
                    </label>
                </div>

                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <x-button type="primary">Inloggen</x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
