<div class="table-responsive">
    <table class="table table-striped">
        <x-table-header :headers="$headers" :amountOfLinks="$tableLinks->count()"></x-table-header>
        @foreach($items as $item)
            <x-table-row :item="$item" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"></x-table-row>
        @endforeach
    </table>
</div>
