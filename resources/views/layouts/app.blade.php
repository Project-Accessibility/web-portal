<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    <x-nav-bar/>

    <main class="container w-container rounded mt-4">
        @if (session()->has('success') || !empty($success))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="alert alert-success">
                        {{ session()->get('success') ?? $success }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if(isset(parse_url(url()->current())['path']))
                        <x-breadcrumb />
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
