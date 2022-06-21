<tr @if($rowLink) class="clickable-row" data-href="{{ $rowLink }}" @endif>
    @foreach($rowItems as $rowItem)
        @if(gettype($rowItem) === 'boolean')
            <td class="align-middle p-0">
                @if($rowItem === true)
                    <svg xmlns="http://www.w3.org/2000/svg" height="26" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" height="26" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                @endif
            </td>
        @else
            <td class="align-middle">
            <span class="table-row-text" style="--truncateLines: {{ count($tableLinks) + 1 }};">{{
                  $rowItem
            }}</span>
            </td>
        @endif
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
