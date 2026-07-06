@switch($field['type'])

    @case('text')
        @include('tenant.editor.fields.text', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

    @case('textarea')
        @include('tenant.editor.fields.textarea', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

    @case('url')
        @include('tenant.editor.fields.url', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

    @case('number')
        @include('tenant.editor.fields.number', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

    @case('color')
        @include('tenant.editor.fields.color', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

    @case('image')
        @include('tenant.editor.fields.image', [
            'field' => $field,
            'settings' => $settings
        ])
        @break

@endswitch