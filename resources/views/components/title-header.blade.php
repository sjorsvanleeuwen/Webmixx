<div class="row mb-3">
    <h1 class="d-flex justify-content-between align-items-center">
        {{ $slot }}
        @if(isset($buttons))
            <div class="text-end">
                {!! $buttons !!}
            </div>
        @endif
    </h1>
</div>
