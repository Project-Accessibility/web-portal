@extends('layouts.default')

@section('content')
    <div class="col-md-4 mx-auto mt-5">
        <div class="p-3 bg-white">
            <h1>{{ __('Wachtwoord resetten') }}</h1>
            <hr />
            @if (session('status'))
                <div class="alert alert-success">
                    {{ __('passwords.sent') }}
                </div>
            @endif
            <form class="m-t-md"
                  role="form"
                  method="POST"
                  data-controller="layouts--form"
                  data-action="layouts--form#submit"
                  data-layouts--form-button-animate="#button-email"
                  data-layouts--form-button-text="{{ __('Loading...') }}"
                  action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <x-input type="text" label="{{ __('Emailadres') }}" name="email" placeholder="{{__('Voer jouw email in')}}" required="true"></x-input>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" id="button-email" type="submit">
                        <i class="icon-envelope text-xs mr-2"></i> {{ __('Stuur wachtwoord reset link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
