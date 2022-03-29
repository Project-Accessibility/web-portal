<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($paths as $path)
            @if($loop->last)
                <li class="breadcrumb-item active">{{ ucfirst($path['view']) }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $path['url'] }}">{{ ucfirst($path['view']) }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
