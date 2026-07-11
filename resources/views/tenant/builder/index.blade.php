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
<div class="modal fade" id="newPageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Yeni Sayfa Oluştur</h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <label class="form-label">
                    Sayfa Adı
                </label>

                <input
                    id="pageTitle"
                    class="form-control"
                    type="text"
                    placeholder="Örn: Blog"
                >

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Vazgeç
                </button>

                <button
                    id="createPageBtn"
                    class="btn btn-primary">
                    Oluştur
                </button>

            </div>

        </div>
    </div>
</div>

@endsection