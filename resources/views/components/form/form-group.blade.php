@props(['colClass' => 'col-md-6 col-12'])

<div {{ $attributes->merge(['class' => $colClass . ' ']) }}>
    <div class="mb-1">
        {{ $slot }}
    </div>
</div>
