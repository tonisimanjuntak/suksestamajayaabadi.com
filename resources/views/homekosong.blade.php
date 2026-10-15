@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header pb-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.6rem;">
                        <i class="fas fa-home text-primary mr-2"></i>Selamat Datang
                    </h1>
                    <p class="text-muted mb-0 small">
                        {{ date('l, d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            @if(session('usaha_logo'))
                                <img src="{{ public_path('images/'. session('usaha_logo')) }}" alt="Logo"
                                    style="max-height: 100px;" class="mb-3">
                            @else
                                <i class="fas fa-building fa-4x text-primary mb-3"></i>
                            @endif

                            <h3 class="font-weight-bold text-dark">{{ session('usaha_nama', 'Sistem ERP Distribusi') }}</h3>
                            <p class="text-muted mb-4">
                                Sistem informasi terpadu untuk mengelola transaksi pembelian, penjualan,<br>
                                hutang-piutang, persediaan, dan pelaporan keuangan.
                            </p>
                            <hr>
                            <div class="row justify-content-center mt-3">
                                <div class="col-auto">
                                    <small class="text-muted">
                                        <i class="fas fa-user mr-1"></i> Login sebagai:
                                        <span class="font-weight-bold">{{ session('namapengguna', '-') }}</span>
                                    </small>
                                </div>
                                <div class="col-auto">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt mr-1"></i> Otorisasi:
                                        <span class="font-weight-bold">{{ session('idotorisasi', '-') }}</span>
                                    </small>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-code-branch mr-1"></i> Laravel 10 &middot; AdminLTE 3.2
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
