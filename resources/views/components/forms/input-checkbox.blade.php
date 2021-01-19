<div class="form-group">
    <div class="form-check">
        <input class="form-check-input {{ $stateClass() }}" type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($checked) checked @endif @if($hasErrors()) aria-describedby="{{ $name }}Feedback" @endif>
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
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
