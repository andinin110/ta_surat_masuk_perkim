@extends('layouts.user')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Dashboard @auth {{ auth()->user()->bidang->name ?? 'Bidang Tidak Ditemukan' }} @endauth
    </h1>
</div>

<!-- Content Row -->
<div class="row">
<!-- Surat berdasarkan status -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Surat Belum Diproses</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $suratBelumDiproses }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Surat Diproses</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $suratDiproses }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Surat Sudah Diproses</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $suratSudahDiproses }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
