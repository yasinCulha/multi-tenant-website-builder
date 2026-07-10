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

@endsection