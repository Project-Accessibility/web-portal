<nav>
    <ul class="nav nav-tabs" id="{{ $title }}">
        @foreach($tabs as $tab)
            <li class="nav-item" role="presentation">
                <span
                    class="nav-link {{ $tab == $currentTab? 'active' : null}}"
                    id="link-{{ $tab }}"
                    data-bs-toggle="tab"
                    data-bs-target="#{{ $tab }}"
                    role="tab"
                    aria-controls="{{ $tab }}"
                    aria-selected="{{ $tab === $currentTab }}">
                    {{ ucfirst($tab) }}
                </span>
            </li>
        @endforeach
    </ul>
</nav>
<div class="tab-content" id="{{ $title }}content">
    @foreach($tabs as $tab)
        <div
            class="tab-pane fade show {{ $tab === $currentTab ? 'show active' : null }}"
            id="{{ $tab }}"
            aria-labelledby="{{ $tab }}-tab">
            @yield($tab)
        </div>
    @endforeach
</div>
