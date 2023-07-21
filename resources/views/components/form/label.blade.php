@props(['for', 'title'])
<label class="form-label" for="{{ $for }}">{{ $title }} <span class="text-danger">*</span>
    {{ $slot }}
</label>
