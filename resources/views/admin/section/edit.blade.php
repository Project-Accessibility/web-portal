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
    <form method="POST" action="{{route('sections.update', [$research->id,$questionnaire->id, $section->id])}}">
        @csrf
        @method('PUT')

        <h1 class="title">{{$section->title}} Aanpassen</h1>
        <div class="col-md-6">
            <x-input type="text" label="Titel" name="title" placeholder="Titel van het onderdeel" :value="$section->title"></x-input>
            <x-input required="0" type="textarea" label="Omschrijving" name="description"
                     placeholder="Een kleine omschrijving van het onderdeel" :extraData="['rows'=>8]" :value="$section->description"></x-input>
            <x-input required="0" type="textarea" label="Locatie omschrijving" name="location_description"
                     placeholder="Een kleine omschrijving van de locatie" :extraData="['rows'=>8]" :value="$section->location_description"></x-input>
            <x-button class="float-end mt-2" type="secondary">Aanpassen</x-button>
        </div>
    </form>
@endsection
