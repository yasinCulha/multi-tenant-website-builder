<div class="mb-3">

    <label class="form-label">
        {{ $field['label'] }}
    </label>

    <input
        type="url"
        class="form-control editor-field"
        name="{{ $field['path'] }}"
        data-path="{{ $field['path'] }}"
        value="{{ data_get($settings, $field['path']) }}"
        placeholder="{{ $field['placeholder'] ?? '' }}">

</div>