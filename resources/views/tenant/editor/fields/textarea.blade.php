<div class="mb-3">

    <label class="form-label">
        {{ $field['label'] }}
    </label>

    <textarea
        class="form-control editor-field"
        name="{{ $field['path'] }}"
        data-path="{{ $field['path'] }}"
        placeholder="{{ $field['placeholder'] ?? '' }}"
        rows="5">{{ data_get($settings, $field['path']) }}</textarea>

</div>