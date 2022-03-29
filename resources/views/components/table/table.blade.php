<table class="table table-striped">
    <x-table-header :headers="$headers" :amountOfLinks="$tableLinks->count()"></x-table-header>
    @foreach($items as $item)
        <x-table-row :item="$item" :keys="$keys" :tableLinks="$tableLinks"></x-table-row>
    @endforeach
</table>
