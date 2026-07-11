@extends('tenant.builder.layouts.app')

@section('content')

<div class="builder-app">

    @include('tenant.builder.components.topbar')

    <div class="builder-main">

        @include('tenant.builder.components.sidebar')

        @include('tenant.builder.components.preview')

        @include('tenant.builder.components.settings-panel')

    </div>

    @include('tenant.builder.components.bottombar')

</div>

<div class="builder-modal" id="newPageModal" aria-hidden="true" data-builder-modal>
    <div class="builder-modal-backdrop" data-close-new-page-modal></div>

    <form class="builder-modal-dialog" data-new-page-form>
        <div class="builder-modal-header">
            <h2>Yeni Sayfa Olustur</h2>
            <button class="builder-modal-close" type="button" data-close-new-page-modal aria-label="Kapat">
                x
            </button>
        </div>

        <div class="builder-modal-body">
            <label class="builder-field">
                <span>Sayfa Adi</span>
                <input
                    id="pageTitle"
                    name="title"
                    type="text"
                    placeholder="Orn: Blog"
                    data-page-title-input
                    required
                >
            </label>

            <label class="builder-field">
                <span>Slug</span>
                <input
                    id="pageSlug"
                    name="slug"
                    type="text"
                    placeholder="orn: blog"
                    data-page-slug-input
                >
            </label>

            <label class="builder-field">
                <span>Sayfa Nereye Eklensin?</span>
                <select id="pagePosition" name="position" data-page-position-select>
                    <option value="start">Listenin Basina</option>
                    @foreach($builder['pages'] as $page)
                        <option value="after:{{ $page->id }}">{{ $page->title }}'dan Sonra</option>
                    @endforeach
                    <option value="end" selected>Listenin Sonuna</option>
                </select>
            </label>

            <div class="builder-form-error" data-new-page-error hidden></div>
        </div>

        <div class="builder-modal-footer">
            <button class="builder-modal-secondary" type="button" data-close-new-page-modal>
                Vazgec
            </button>

            <button class="builder-modal-primary" type="submit" id="createPageBtn">
                Olustur
            </button>
        </div>
    </form>
</div>

@endsection
