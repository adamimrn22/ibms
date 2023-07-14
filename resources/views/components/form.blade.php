@props(['action', 'id', 'method' => 'GET'])

<form {{ $attributes->merge(['class' => 'form']) }} id="{{ $id }}" action="{{ $action }}"
    method="{{ $method }}">
    @csrf
    <div class="row">
        {{ $slot }}
    </div>
</form>
