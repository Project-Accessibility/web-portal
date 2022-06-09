@extends('layouts.default')

@section('content')
    <div class="col-md-4 mx-auto mt-5">
        <div class="p-3 bg-white">
            <h1>{{ __('Wachtwoord resetten') }}</h1>
            <hr />
            <form class="m-t-md"
                  role="form"
                  method="POST"
                  data-controller="layouts--form"
                  data-action="layouts--form#submit"
                  data-layouts--form-button-animate="#button-reset"
                  data-layouts--form-button-text="{{ __('Loading...') }}"
                  action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <x-input type="text" label="{{ __('Emailadres') }}" name="email" placeholder="{{__('Voer jouw email in')}}" required="true" value="{{$email}}"></x-input>
                </div>
                <div class="form-group">
                    <x-input type="password" label="{{ __('Wachtwoord') }}" name="password" placeholder="{{__('Voer jouw wachtwoord in')}}" required="true"></x-input>
                </div>
                <div class="form-group">
                    <x-input type="password" label="{{ __('Bevestig wachtwoord') }}" name="password_confirmation" placeholder="{{__('Voer jouw wachtwoord in')}}" required="true"></x-input>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" id="button-reset" type="submit">
                        <i class="icon-refresh text-xs mr-2"></i> {{ __('Wachtwoord resetten') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
