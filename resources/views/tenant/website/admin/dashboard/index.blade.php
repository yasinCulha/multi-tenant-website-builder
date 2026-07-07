@extends('tenant.website.layouts.app')

@section('title', 'Tema Yönetimi')

@section('content')
        @if(session('success'))
            <div class="alert alert-success bg-success-subtle text-success border-0 d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="row mb-4" id="temaListesiGrid">

            @php
                $aktif_tema = $themes->first(fn($t) => $company->theme_id == $t->id);
            @endphp

            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="fw-bold text-white mb-3">Seçili Temanız</h2>
                    @if($aktif_tema)
                        <div class="card p-3 shadow border-success" style="background:#1e293b; max-width:500px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-success mb-2">
                                        <i class="fa-solid fa-circle-check me-1"></i> Aktif Tema
                                    </span>
                                    <h4 class="text-white mb-0">{{ $aktif_tema->name }}</h4>
                                </div>
                                <a href="{{ route('company.theme.editor', ['theme' => $aktif_tema->id]) }}"target="_blank" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Düzenle
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning d-inline-block" style="min-width: 300px;">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> Tema seçilmedi.
                        </div>
                    @endif
                </div>
            </div>

            <hr class="border-secondary mb-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h2 class="fw-bold text-white mb-0">Tema Listesi</h2>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end mt-3 mt-md-0">
                    <div style="width:350px; max-width: 100%;">
                        <div class="input-group">
                            <input type="text" 
                                id="temaAramaInput" 
                                class="form-control" 
                                placeholder="Tema modeli ara..." 
                                oninput="filterThemes()">
                            <button class="btn btn-outline-light">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($themes as $tekil_tema_verisi)
                    @php
                        $bu_tema_aktif_mi = ($company->theme_id == $tekil_tema_verisi->id);
                    @endphp

                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100 shadow-sm border-light rounded-3 overflow-hidden {{ $bu_tema_aktif_mi ? 'secili-aktif-tema-karti border-success border-2' : '' }}" style="background-color: #111827;">
                            
                            <div class="kart-resim-alani w-100 position-relative">
                                <div class="yapay-grafik-arkasi {{ $tekil_tema_verisi->slug }} text-center text-white py-5 fw-bold">
                                    {{ $tekil_tema_verisi->name }}
                                </div>

                                <div class="kart-hover-katmani">
                                    @if($bu_tema_aktif_mi)
                                        {{-- Aktif tema ise Düzenle Butonu --}}
                                        <a href="{{ route('company.theme.editor', ['theme' => $tekil_tema_verisi->id]) }}" target="_blank" class="btn btn-success btn-sm w-75 fw-semibold py-2">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Temayı Düzenle
                                        </a>
                                    @else
                                        {{-- Aktif değilse Temayı Seç Formu --}}
                                        <a href="{{ route('theme.preview', ['themeId' => $tekil_tema_verisi->id]) }}" target="_blank" class="btn btn-light btn-sm w-75 fw-semibold py-2 mb-2">
                                            <i class="fa-solid fa-eye me-1"></i> Ön İzleme
                                        </a>
                                        <form action="{{ route('company.theme.update') }}" method="POST" class="w-75"">
                                            @csrf
                                            <input type="hidden" name="theme_id" value="{{ $tekil_tema_verisi->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm w-100 fw-semibold py-2" style="background:#6366f1; border:none;">
                                                <i class="fa-solid fa-check me-1"></i> Temayı Seç
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body d-flex justify-content-between align-items-center py-3 bg-white">
                                <h6 class="card-title fw-bold m-0 text-dark text-truncate" style="max-width: 65%;">
                                    {{ $tekil_tema_verisi->name }}
                                </h6>
                                
                                @if($bu_tema_aktif_mi)
                                    <span class="badge text-success bg-success-subtle px-3 py-1 rounded-pill fw-bold">
                                        <i class="fa-solid fa-check me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge text-secondary bg-light px-3 py-1 rounded-pill fw-medium">
                                        Tasarım
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>