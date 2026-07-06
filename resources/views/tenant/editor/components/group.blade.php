<div class="editor-group">

    <div class="editor-group-header">

        @if(!empty($group['icon']))
            <div class="editor-group-icon">
                <i class="{{ $group['icon'] }}"></i>
            </div>
        @endif

        <div style="auto:auto-scroll;">   

            <h5 class="editor-group-title">
                {{ $group['title'] }}
            </h5>

            @if(!empty($group['description']))
                <p class="editor-group-description">
                    {{ $group['description'] }}
                </p>
            @endif

        </div>

    </div>

    <div class="editor-group-body">

        @foreach($group['fields'] as $field)

            @include('tenant.editor.components.field',[
                'field'=>$field,
                'settings'=>$settings
            ])

        @endforeach

    </div>

</div>