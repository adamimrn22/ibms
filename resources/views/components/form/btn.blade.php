@props(['id' => '', 'title', 'type' => 'button'])
<button id="{{ $id }}" type="{{ $type }}"
    {{ $attributes->merge(['class' => 'btn me-1 waves-effect ']) }}>
    {{ $slot }}
    <span>{{ $title }}</span>
</button>
