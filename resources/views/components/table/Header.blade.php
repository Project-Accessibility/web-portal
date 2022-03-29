<thead>
    <tr>
        @foreach($headers as $header)
            <th scope="col">{{$header}}</th>
        @endforeach
        @if($amountOfLinks > 0)
            <th>
                @if($amountOfLinks == 1) actie
                @else acties @endif
            </th>
        @endif
    </tr>
</thead>
