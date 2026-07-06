<div class="editor-sidebar">

    <div class="sidebar-title">
        <i class="fa-solid fa-sliders"></i>
        <span>Düzenleme Menüsü</span>
    </div>

    <div class="sidebar-menu">

        @foreach($editor['sections'] as $index => $section)

            <button
                class="menu-item {{ $index === 0 ? 'active' : '' }}"
                data-panel="{{ $section['id'] }}">

                <i class="{{ $section['icon'] }}"></i>

                <span>
                    {{ $section['title'] }}
                </span>

            </button>

        @endforeach

    </div>

</div>