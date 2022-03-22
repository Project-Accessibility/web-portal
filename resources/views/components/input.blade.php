<div class="{{$type != "switch" ? "form-group" : "form-check form-switch"}}">
    <label for="{{$name}}">{{strtoupper(substr($name, 0, 1)) . substr($name, 1)}}</label>
    @switch($type)
        @case("text")
        <input class="form-control" type="text" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               placeholder="{{$placeholder}}" value="{{$value}}"/>
        @break
        @case("password")
        <input class="form-control" type="password" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               placeholder="{{$placeholder}}"/>
        @break
        @case("select")
        <select class="form-control" id="{{$name}}" title="{{$name}}"
                name="{{$name}}" {{$extraData["multiple"]?"multiple":""}}>
            @foreach($extraData["options"] as $option)
                @if(($index == 0 && empty($value))||$value==$option[1])
                    <option selected value="{{$option[1]}}">{{$option[0]}}</option>
                @else
                    <option value="{{$option[1]}}">{{$option[0]}}</option>
                @endif
            @endforeach
        </select>
        @break
        @case("date")
        <input class="form-control" type="date" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               value="{{$value}}"/>
        @break
        @case("datetime")
        <input class="form-control" type="datetime-local" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               value="{{$value}}"/>
        @break
        @case("switch")
        <input type="checkbox" class="form-check-input" id="{{$name}}" title="{{$name}}"
               name="{{$name}}" {{$value ? 'checked': ''}}/>
        @break
        @case("range")
        <div class="d-flex">
            <input type="range" class="form-range w-75" min="{{$extraData["min"]}}" max="{{$extraData["max"]}}"
                   step="{{$extraData["step"]}}" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                   placeholder="{{$placeholder}}" value="{{$value?$value:0}}">
            <output class="mx-3" name="output-{{$name}}" id="output-{{$name}}">{{$value?$value:0}}</output>
        </div>
        <script>
            window.addEventListener('load', () => {
                const input = document.getElementById('{{$name}}');
                const output = document.getElementById('output-{{$name}}');
                input.addEventListener('input', () => {
                    output.value = input.value;
                })
            })
        </script>
        @break
    @endswitch
</div>
