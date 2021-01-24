<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select {{ $attributes }} class="form-control {{ $stateClass() }}" id="{{ $name }}" name="{{ $name }}" @if($hasErrors()) aria-describedby="{{ $name }}Feedback" @endif>
        @if($emptyFirst)
            <option value="" @if($allowEmpty === false) disabled @endif @if($isSelected('')) selected @endif>Please Select</option>
        @endif
        @foreach($options as $option_key => $option_value)
            <option value="{{ $option_key }}" @if($isSelected($option_key)) selected @endif>{{ $option_value }}</option>
        @endforeach
    </select>
    @if($hasErrors())
        <div id="{{ $name }}Feedback" class="invalid-feedback">
            <ul>
                @foreach($getErrors() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
