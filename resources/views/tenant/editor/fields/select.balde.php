<div class="mb-3">

    <label class="form-label">
        {{ $field['label'] }}
    </label>

    <select
        class="form-select editor-field"
        name="{{ $field['path'] }}"
        data-path="{{ $field['path'] }}">

        @foreach($field['options'] as $value => $label)

            <option
                value="{{ $value }}"
                @selected(data_get($settings, $field['path']) == $value)>

                {{ $label }}

            </option>

        @endforeach

    </select>

</div>