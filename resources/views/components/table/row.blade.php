<tr>
    @foreach($rowItems as $rowItem)
        <td>
            <span>{{ $rowItem }}</span>
        </td>
    @endforeach
    @if(count($tableLinks) > 0)
        <td>
            @foreach($tableLinks as $name => $link)
                <x-button type="primary" :link="$link">{{ $name }}</x-button>
            @endforeach
        </td>
    @endif
</tr>
