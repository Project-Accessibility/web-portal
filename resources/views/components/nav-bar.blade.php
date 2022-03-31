<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm justify-content-center">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Accessibility
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            {{--//@todo: add authorization--}}
            {{--            @if(Auth::user()->hasRole('admin'))--}}
            @if(1===1)
                <ul class="navbar-nav">
                    <a class="nav-link
                    @if(Request::route()->getPrefix() == '')
                        active-menu
                    @endif
                        " href="">Link</a>
                </ul>

                <ul class="navbar-nav">
                    <a class="nav-link
                    @if(Request::route()->getPrefix() == 'link')
                        active-menu
                    @endif
                        " href="">Link</a>
                </ul>
        @endif
        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
{{--                        {{ Auth::user()->first_name }}--}}
                        Milo
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        {{--//@todo: add logout route--}}
                        <a class="dropdown-item" href=""
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Uitloggen
                        </a>

                        <form id="logout-form" action="" method="POST"
                              class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
