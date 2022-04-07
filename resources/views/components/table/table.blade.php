<div class="table-responsive">
    <table class="table table-striped">
        <x-table-header :headers="$headers" :amountOfLinks="$tableLinks->count()"></x-table-header>
        @if(count($items) > 0)
            @foreach($items as $item)
                <x-table-row :item="$item" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"></x-table-row>
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($keys) + ($tableLinks->count() > 0 ? 1 : 0)}}">
                    <div class="d-flex justify-content-center">
                        <span class="lead">
                            Er zijn nog geen items.
                        </span>
                    </div>
                </td>
            </tr>
        @endif
    </table>
</div>
