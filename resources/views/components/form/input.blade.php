@props(['type' => 'text', 'id', 'placeholder' => '', 'value' => ''])

<input {{ $attributes->merge(['class' => 'form-control']) }} type="{{ $type }}" id="{{ $id }}"
    placeholder="{{ $placeholder }}" name="{{ $id }}" value="{{ old($id, $value) }}">
@error($id)
    <label class="error">{{ $message }}</label>
@enderror
