<main class="builder-preview">

    <div class="website-canvas">

        <div class="canvas-header">
            <span class="canvas-kicker">Current page</span>
            <h2>{{ $builder['currentPage']->title }}</h2>
        </div>

        @forelse($builder['pageModules'] as $pageModule)

            <div class="builder-module">

                <span class="module-handle"></span>
                <span>{{ $pageModule->module->name }}</span>

            </div>

        @empty

            <p class="empty-canvas">Bu sayfada henuz modul yok.</p>

        @endforelse

    </div>

</main>
