<div {{$attributes->merge(['class' => ($type != 'switch' ? 'form-group' : 'form-check form-switch').($errors->has($name) ? ($type == 'switch' ? 'is-invalid highlight-error': '') : '')])}}>
    @if($label)
        <label for="{{$name}}" class="form-label">
            {{ ucfirst($label) }}
            @if($required)
                <span class="text-red ml-1">*</span>
            @endif
        </label>
    @endif
    @switch($type)
        @case('text')
        @if(isset($extraData['before']) || isset($extraData['after']))
            <div class="input-group @error($name) is-invalid @enderror">
                @if(isset($extraData['before']))
                    <span class="input-group-text">{{$extraData['before']}}</span>
                @endif
                <input class="form-control" type="text" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                       placeholder="{{$placeholder}}" value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}/>
                @if(isset($extraData['after']))
                    <span class="input-group-text">{{$extraData['after']}}</span>
                @endif
            </div>
        @else
            <input class="form-control @error($name) is-invalid @enderror" type="text" id="{{$name}}" title="{{$name}}"
                   name="{{$name}}"
                   placeholder="{{$placeholder}}" value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}/>
        @endif
        @break
        @case('email')
        @if(isset($extraData['before']) || isset($extraData['after']))
            <div class="input-group @error($name) is-invalid @enderror">
                @if(isset($extraData['before']))
                    <span class="input-group-text">{{$extraData['before']}}</span>
                @endif
                <input class="form-control" type="email" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                       placeholder="{{$placeholder}}" value="{{old($name) ? old($name) : $value}}" {{$disabled ? 'disabled' : ''}}/>
                @if(isset($extraData['after']))
                    <span class="input-group-text">{{$extraData['after']}}</span>
                @endif
            </div>
        @else
            <input class="form-control @error($name) is-invalid @enderror" type="text" id="{{$name}}" title="{{$name}}"
                   name="{{$name}}"
                   placeholder="{{$placeholder}}" value="{{old($name) ? old($name) : $value}}" {{$disabled ? 'disabled' : ''}}/>
        @endif
        @break
        @case('number')
        @if(isset($extraData['before']) || isset($extraData['after']))
            <div class="input-group @error($name) is-invalid @enderror">
                @if(isset($extraData['before']))
                    <span class="input-group-text">{{$extraData['before']}}</span>
                @endif
                <input class="form-control" type="number" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                       placeholder="{{$placeholder}}" value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}/>
                @if(isset($extraData['after']))
                    <span class="input-group-text">{{$extraData['after']}}</span>
                @endif
            </div>
        @else
            <input class="form-control @error($name) is-invalid @enderror" type="number" id="{{$name}}"
                   title="{{$name}}" name="{{$name}}"
                   placeholder="{{$placeholder}} {{$disabled ? 'disabled' : ''}}" value="{{old($name, $value)}}"/>
        @endif
        @break
        @case('textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" type="text" id="{{$name}}" title="{{$name}}"
                  name="{{$name}}"
                  placeholder="{{$placeholder}}"
                  rows="{{$extraData['rows']}}" {{$disabled ? 'disabled' : ''}}>{{old($name, $value)}}</textarea>
        @break
        @case('password')
        <input class="form-control @error($name) is-invalid @enderror" type="password" id="{{$name}}" title="{{$name}}"
               name="{{$name}}"
               placeholder="{{$placeholder}}" {{$disabled ? 'disabled' : ''}}/>
        @break
        @case('select')
        <div class="@error($name) is-invalid @enderror">
            @if($extraData['multiple'])
                <input type="hidden" name="{{$name}}" value=""/>
            @endif
            <select class="selectpicker form-control" id="{{$name}}" title="{{$name}}"
                    name="{{$name}}{{$extraData['multiple']?'[]':''}}" {{$extraData['multiple']?'multiple':''}} {{$disabled ? 'disabled' : ''}}>
                @foreach($extraData['options'] as $option)
                    @php
                        $value = $extraData['multiple'] ? (old($name, $value) ? old($name, $value) :  []) : old($name, $value) ?? [];
                        $isSelected = !empty($value) && ($extraData['multiple'] ? in_array($option[1], $value) : $value==$option[1])
                    @endphp

                    @if($isSelected)
                        <option selected value="{{$option[1]}}">{{$option[0]}}</option>
                    @else
                        <option value="{{$option[1]}}">{{$option[0]}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @break
        @case('date')
        <input class="form-control @error($name) is-invalid @enderror" type="date" id="{{$name}}" title="{{$name}}"
               name="{{$name}}"
               value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}/>
        @break
        @case('datetime')
        <input class="form-control @error($name) is-invalid @enderror" type="datetime-local" id="{{$name}}"
               title="{{$name}}" name="{{$name}}"
               value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}/>
        @break
        @case('switch')
        <input type="hidden" value="0" name="{{ $name }}"/>
        <input type="checkbox" value="1" class="form-check-input" id="{{$name}}" title="{{$name}}"
               name="{{$name}}" {{is_string(old($name)) ? (old($name) == true ? 'checked': '') : ($value ? 'checked': '')}} {{$disabled ? 'disabled' : ''}}/>
        @break
        @case('range')
        <div class="d-flex @error($name) is-invalid highlight-error @enderror">
            <input type="range" class="form-range" min="{{$extraData['min']}}" max="{{$extraData['max']}}"
                   step="{{$extraData['step']}}" id="{{$name}}" title="{{$name}}" name="{{$name}}"
                   placeholder="{{$placeholder}}" value="{{old($name, $value) ?? 0}}" {{$disabled ? 'disabled' : ''}}>
            <output class="mx-3" name="output-{{$name}}"
                    id="output-{{$name}}">{{old($name, $value) ?? 0}}</output>
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
        <div class="@error($name) is-invalid @enderror">
            <input id="{{$name}}" title="{{$name}}" name="{{$name}}{{$extraData['multiple']?'[]':''}}" type="file"
                   class="file" {{$extraData['multiple']?'multiple':''}}
                   data-show-upload="false" data-show-caption="true" data-msg-placeholder="{{$placeholder}}"
                   value="{{old($name, $value)}}" {{$disabled ? 'disabled' : ''}}>
        </div>
        @break
    @endswitch
    @if($type != 'switch' )
        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endif
</div>
@if($type == 'switch' )
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
@endif
