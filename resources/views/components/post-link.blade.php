<a href="{{ $url }}" @isset($classes) class="{{ $classes}} " @endisset onclick="event.preventDefault(); document.getElementById('{{ md5($url) }}').submit()">
    {!! $slot !!}
</a>
<form id="{{ md5($url) }}" class="d-none" action="{{ $url }}" method="post">
    @method(isset($method) ? $method : 'post')
    @csrf
</form>
