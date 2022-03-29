<ul class="nav nav-tabs">
    @foreach($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{$tab==$currentTab? 'active' : ''}}" id="link-{{$tab}}" href="#{{$tab}}">{{$tab}}</a>
        </li>
    @endforeach
</ul>
@foreach($tabs as $tab)
    <div id="{{$tab}}" {{$tab!=$currentTab? 'hidden' : ''}}>
        @yield($tab)
    </div>
    <script>
        const tabs = {!! json_encode($tabs) !!};
        const links = [];
        window.addEventListener('load', () => {
            tabs.forEach(tab => {
                const link = document.getElementById('link-'+tab);
                links.push(link);
                link.addEventListener('click', (e)=> {
                    e.preventDefault();
                    if(!link.classList.contains('active')){
                        links.forEach(link => {
                            if(link.classList.contains('active')){
                                link.classList.remove('active');
                            }
                            document.getElementById(link.id.replace('link-', '')).hidden=true;
                        })
                        link.classList.add('active');
                        document.getElementById(tab).hidden=false;
                    }
                })
            })
        })
    </script>
@endforeach
