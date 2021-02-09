<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="file" class="form-control-file {{ $stateClass() }}" id="{{ $name }}" name="{{ $name }}" @if($hasErrors()) aria-describedby="{{ $name }}Feedback" @endif>
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
