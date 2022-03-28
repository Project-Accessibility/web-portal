@if($link)
    <a href="{{$link}}"
    @switch($type)
        @case('primary')
            {{ $attributes->merge(['class' => 'btn btn-primary']) }}
        @break
        @case('secondary')
            {{ $attributes->merge(['class' => 'btn btn-secondary']) }}
        @break
        @case('remove')
            {{ $attributes->merge(['class' => 'btn btn-danger']) }}
        @break
        @default
            {{ $attributes->merge(['class' => 'btn btn-primary']) }}
        @break
        @endswitch
    >
        {{$slot}}
    </a>
@else
    <button type="submit"
    @switch($type)
        @case("primary")
            {{ $attributes->merge(['class' => 'btn btn-primary']) }}
            @break
            @case("secondary")
            {{ $attributes->merge(['class' => 'btn btn-secondary']) }}
            @break
            @case("remove")
            {{ $attributes->merge(['class' => 'btn btn-danger']) }}
            @break
            @default
            {{ $attributes->merge(['class' => 'btn btn-primary']) }}
            @break
        @endswitch
    >
        {{$slot}}
    </button>
@endif
