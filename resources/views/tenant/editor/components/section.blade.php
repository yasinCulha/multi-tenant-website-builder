<div
    id="{{ $section['id'] }}-panel"
    class="settings-panel editor-panel {{ $loop->first ? 'active-panel' : '' }}">

    <div class="panel-header">
        <i class="{{ $section['icon'] }}"></i>
        <h4>{{ $section['title'] }}</h4>

    </div>

    @foreach($section['groups'] as $group)

        @include(
            'tenant.editor.components.group',
            [
                'group' => $group
            ]
        )

    @endforeach

</div>