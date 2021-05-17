<div class="row g-3 mb-3">
    <div class="col-2">
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    <div class="col-8">
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
</div>
