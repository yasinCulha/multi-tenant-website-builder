@extends('tenant.builder.layouts.app')

@section('content')

@include('tenant.builder.components.topbar')
<div class="builder">

    @include('tenant.builder.components.sidebar')

    @include('tenant.builder.components.preview')

    @include('tenant.builder.components.settings-panel')

</div>
@include('tenant.builder.components.bottombar')

@endsection 