<div class="sidebar-content">

    @foreach($builder['pages'] as $page)

        <div class="sidebar-item {{ $builder['currentPage']->id == $page->id ? 'active' : '' }}">
            {{ $page->title }}
        </div>

    @endforeach

</div>