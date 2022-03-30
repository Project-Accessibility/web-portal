<tr @if($rowLink) class="clickable-row" data-href="{{ $rowLink }}" @endif>
    @foreach($rowItems as $rowItem)
        <td>
            <span>{{ $rowItem }}</span>
        </td>
    @endforeach
    @if(count($tableLinks) > 0)
        <td>
            @foreach($tableLinks as $display => $link)
                <x-button type="primary" :link="$link">{{ ucfirst($display) }}</x-button>
            @endforeach
        </td>
    @endif
</tr>
