@if(count($paths) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" id="breadcrumbs">
            @foreach($paths as $path)
                @if($loop->last)
                    <li class="breadcrumb-item active">{{ ucfirst($path['display']) }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $path['url'] }}">{{ ucfirst($path['display']) }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
