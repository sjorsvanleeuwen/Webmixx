<div class="row mb-2 mb-xl-3">
    <div class="col-auto">
        <h1>{{ $slot }}</h1>
    </div>
    @if(isset($buttons))
        <div class="col-auto ml-auto text-right mt-2">
            {!! $buttons !!}
        </div>
    @endif
</div>
