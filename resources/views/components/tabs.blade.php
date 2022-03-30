<ul class="nav nav-tabs">
    @foreach($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{$tab==request()->query("tab")? 'active' : ''}}" id="link-{{$tab}}"
               href="?tab={{$tab}}">{{$tab}}</a>
        </li>
    @endforeach
</ul>
@foreach($tabs as $tab)
   @if($tab==request()->query("tab"))
       @yield($tab)
   @endif
@endforeach
