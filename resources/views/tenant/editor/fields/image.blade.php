<div class="mb-3">

    <label class="form-label">
        {{ $field['label'] }}
    </label>

    <input
        type="file"
        class="form-control editor-field"
        name="{{ $field['path'] }}"
        data-path="{{ $field['path'] }}"
        accept="image/*">

</div>