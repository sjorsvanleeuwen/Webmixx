<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea rows="3" class="form-control form-control-editor {{ $stateClass() }}" id="{{ $name }}" name="{{ $name }}" @if($hasErrors()) aria-describedby="{{ $name }}Feedback" @endif>
        {{ $value }}
    </textarea>
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
