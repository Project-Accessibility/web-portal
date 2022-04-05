<tr @if($rowLink) class="clickable-row" data-href="{{ $rowLink }}" @endif>
    @foreach($rowItems as $rowItem)
        <td class="align-middle">
            <span>{{
                strlen($rowItem) > 100 ? substr($rowItem, 0, 100) . '...' : $rowItem
            }}</span>
        </td>
    @endforeach
    @if(count($tableLinks) > 0)
        <td class="align-middle">
            <div class="d-flex gap-2">
                @foreach($tableLinks as $display => $link)
                    <x-button type="primary" :link="$link">{{ ucfirst($display) }}</x-button>
                @endforeach
            </div>
        </td>
    @endif
</tr>
