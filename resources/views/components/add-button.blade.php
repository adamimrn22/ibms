@props(['title', 'addRoute'])

<a href="{{ route($addRoute) }}" class="btn add-new btn-primary mt-50">
    <span>Add New {{ $title }}</span>
</a>
