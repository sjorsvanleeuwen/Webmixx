<fieldset class="row g-3 mb-3">
    <legend class="col-form-label col-3 pt-0">{{ $label }}</legend>
    <div class="col-9">
        <div class="form-check form-switch">
            <input class="form-check-input {{ $stateClass() }}" type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($checked) checked @endif @if($hasErrors()) aria-describedby="{{ $name }}Feedback" @endif>
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
</fieldset>
