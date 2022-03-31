<div class="{{$type != "switch" ? "form-group" : "form-check form-switch"}}">
    <label for="{{$name}}" class="form-label">{{strtoupper(substr($label, 0, 1)) . substr($label, 1)}}</label>
    @switch($type)
        @case('text')
        @if(isset($extraData['before']) || isset($extraData['after']))
            <div class="input-group">
                @if(isset($extraData['before']))
                    <span class="input-group-text">{{$extraData['before']}}</span>
                @endif
                <input class="form-control" type="text" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                       placeholder="{{$placeholder}}" value="{{$value}}"/>
                @if(isset($extraData['after']))
                        <span class="input-group-text">{{$extraData['after']}}</span>
                @endif
            </div>
        @else
            <input class="form-control" type="text" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                   placeholder="{{$placeholder}}" value="{{$value}}"/>
        @endif
        @break
        @case('textarea')
            <textarea class="form-control" type="text" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                   placeholder="{{$placeholder}}" rows="{{$extraData['rows']}}">{{$value}}</textarea>
        @break
        @case('password')
        <input class="form-control" type="password" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               placeholder="{{$placeholder}}"/>
        @break
        @case('select')
        <select class="form-select" id="{{$name}}" title="{{$name}}"
                name="{{$name}}{{$extraData['multiple']?'[]':''}}" {{$extraData['multiple']?'multiple':''}}>
            @foreach($extraData['options'] as $option)
                @if(($loop->index == 0 && empty($value))||$value==$option[1])
                    <option selected value="{{$option[1]}}">{{$option[0]}}</option>
                @else
                    <option value="{{$option[1]}}">{{$option[0]}}</option>
                @endif
            @endforeach
        </select>
        @break
        @case('date')
        <input class="form-control" type="date" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               value="{{$value}}"/>
        @break
        @case('datetime')
        <input class="form-control" type="datetime-local" id="{{$name}}" title="{{$name}}" name="{{$name}}"
               value="{{$value}}"/>
        @break
        @case('switch')
        <input type="checkbox" class="form-check-input" id="{{$name}}" title="{{$name}}"
               name="{{$name}}" {{$value ? 'checked': ''}}/>
        @break
        @case('range')
        <div class="d-flex">
            <input type="range" class="form-range w-75" min="{{$extraData['min']}}" max="{{$extraData['max']}}"
                   step="{{$extraData['step']}}" id="{{$name}}" title="{{$name}}" name="{{$name}}"
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
        @case('file')
        <input id="{{$name}}" title="{{$name}}" name="{{$name}}{{$extraData['multiple']?'[]':''}}" type="file"
               class="file" {{$extraData['multiple']?'multiple':''}}
               data-show-upload="false" data-show-caption="true" data-msg-placeholder="{{$placeholder}}"
               value="{{$value}}">
        @break
    @endswitch
</div>
