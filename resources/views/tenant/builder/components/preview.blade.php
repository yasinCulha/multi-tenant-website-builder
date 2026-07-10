<main class="builder-preview">

    <div class="website-canvas">

        <h2>{{ $builder['currentPage']->title }}</h2>

        @forelse($builder['pageModules'] as $pageModule)

            <div class="builder-module">

                {{ $pageModule->module->name }}

            </div>

        @empty

            <p>Bu sayfada henüz modül yok.</p>

        @endforelse

    </div>

</main>