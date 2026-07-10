<div class="builder-preview">

    <h2>{{ $builder['currentPage']->title }}</h2>

    @forelse($builder['pageModules'] as $pageModule)

        <div style="padding:20px;margin-bottom:10px;background:white;border-radius:10px;">

            {{ $pageModule->module->name }}

        </div>

    @empty

        <p>Bu sayfada henüz modül yok.</p>

    @endforelse

</div>