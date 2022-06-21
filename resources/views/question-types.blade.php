@extends('layouts.app')

@section('content')
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

    <h1 class="title">Question types preview</h1>
    <div class="col-md-6">
        <div>
            <p class="h2">Audio</p>
            <audio controls>
                <source src="https://jaap.su/youLost.mp3" type="audio/mpeg">
            </audio>
        </div>
    </div>
@endsection
