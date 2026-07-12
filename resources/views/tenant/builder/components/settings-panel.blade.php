<div class="builder-settings" data-builder-settings>

    @php
        $selectedModule = $builder['pageModules']->first();
    @endphp

    @if(($builder['currentPage'] ?? null) && $builder['pageModules']->isEmpty())

        <div class="settings-header">
            <span class="settings-kicker">Bos Sayfa</span>
            <h3>{{ $builder['currentPage']->title }}</h3>
        </div>

        <div class="settings-empty-state">
            Bu sayfa bos. Soldaki Moduller bolumunden bir modul ekleyerek baslayabilirsiniz.
        </div>

    @elseif($selectedModule)
        @php
            $fields = $selectedModule->themeModule?->fields ?? collect();
            $contents = $selectedModule->contents->keyBy('field_key');
            $supportedTypes = ['text', 'textarea', 'image', 'color', 'url', 'number', 'checkbox'];
        @endphp

        <div class="settings-header">
            <span class="settings-kicker">Secili Modul</span>

            <h3>
                {{ $selectedModule->themeModule->name }}
            </h3>
        </div>

        <div class="settings-body">

            @forelse($fields as $field)
                @php
                    $type = in_array($field->type, $supportedTypes, true) ? $field->type : 'text';
                    $inputType = $type === 'image' ? 'text' : $type;
                    $value = $contents->get($field->field_key)?->field_value ?? $field->default_value;
                    $fieldId = 'field-' . $selectedModule->id . '-' . $field->field_key;
                @endphp

                {{-- Field tanimlari theme_page_module_fields tablosundan dinamik uretilir. --}}
                <div class="settings-section">
                    <label for="{{ $fieldId }}">
                        {{ $field->field_name }}
                    </label>

                    @if($type === 'textarea')
                        <textarea
                            id="{{ $fieldId }}"
                            class="settings-textarea"
                            name="{{ $field->field_key }}"
                            data-page-module-id="{{ $selectedModule->id }}"
                            data-field-key="{{ $field->field_key }}"
                            rows="5"
                            placeholder="{{ $field->placeholder }}"
                            @required($field->is_required)
                        >{{ $value }}</textarea>
                    @elseif($type === 'checkbox')
                        <label class="settings-checkbox">
                            <input
                                id="{{ $fieldId }}"
                                type="checkbox"
                                name="{{ $field->field_key }}"
                                data-page-module-id="{{ $selectedModule->id }}"
                                data-field-key="{{ $field->field_key }}"
                                value="1"
                                @checked(filter_var($value, FILTER_VALIDATE_BOOLEAN))
                            >
                            <span>Aktif</span>
                        </label>
                    @else
                        <input
                            id="{{ $fieldId }}"
                            type="{{ $inputType }}"
                            class="settings-input"
                            name="{{ $field->field_key }}"
                            data-page-module-id="{{ $selectedModule->id }}"
                            data-field-key="{{ $field->field_key }}"
                            value="{{ $value }}"
                            placeholder="{{ $field->placeholder }}"
                            @required($field->is_required)
                        >
                    @endif
                </div>
            @empty
                <div class="settings-empty-state">
                    Bu modul icin editlenebilir alan tanimlanmamis.
                </div>
            @endforelse

        </div>

    @else

        <div class="settings-header">
            <span class="settings-kicker">Builder</span>
            <h3>Modul Secilmedi</h3>
        </div>

        <div class="settings-empty-state">
            Onizleme alanindan bir modul secerek duzenlemeye baslayabilirsiniz.
        </div>

    @endif

</div>
