@extends('tenant.builder.layouts.app')

@section('content')

<div class="builder">

    @include('tenant.builder.components.sidebar')

    @include('tenant.builder.components.preview')

    @include('tenant.builder.components.settings-panel')

</div>

@endsection