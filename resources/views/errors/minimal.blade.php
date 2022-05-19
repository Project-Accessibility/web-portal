<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link href="{{asset('css/app.css')}}" rel="stylesheet"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('images/icon.png')}}"/>

    </head>
    <body class="antialiased container d-flex vh-100 vw-100 justify-content-center">
        <div class="align-self-center">
            <div class="h1">
                @yield('code'): @yield('header')
            </div>

                @yield('message')

                <x-button type="primary" link="{{route('home')}}">Ga terug naar homepagina</x-button>
        </div>
    </body>
</html>
