<div class="mb-3">

    <label class="form-label">
        {{ $field['label'] }}
    </label>

    <input
        type="color"
        class="form-control form-control-color editor-field"
        name="{{ $field['path'] }}"
        data-path="{{ $field['path'] }}"
        value="{{ data_get($settings, $field['path'], '#000000') }}">

</div>