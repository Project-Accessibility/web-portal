<tr @if($rowLink) class="clickable-row" data-href="{{ $rowLink }}" @endif>
    @foreach($rowItems as $rowItem)
        <td class="align-middle">
            <span class="table-row-text" style="--truncateLines: {{ count($tableLinks) + 1 }};">{{
                $rowItem
            }}</span>
        </td>
    @endforeach
    @if(count($tableLinks) > 0)
        <td class="align-middle smallCell">
            <div class="d-flex flex-md-nowrap flex-wrap gap-2">
                @foreach($tableLinks as $display => $link)
                    <x-button type="primary" :link="$link">{{ ucfirst($display) }}</x-button>
                @endforeach
            </div>
        </td>
    @endif
</tr>
