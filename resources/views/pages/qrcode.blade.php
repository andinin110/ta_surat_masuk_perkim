@extends('layouts.admin')

@section('title', 'QR Code Disposisi')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">QR Code Disposisi</h4>

    <div class="card p-4">
        <p><strong>Surat:</strong> {{ $disposisi->surat->nomor_surat }}</p>
        <p><strong>Bidang:</strong> {{ $disposisi->bidang->name }}</p>
        <p><strong>Status:</strong> {{ $disposisi->status }}</p>

        <div class="text-center my-4">
            {!! QrCode::size(250)->generate($qrData) !!}
        </div>

        {{-- <div class="text-center">
            <a href="{{ route('disposisi.view', $disposisi->id) }}" class="btn btn-primary">
                Lihat Detail Disposisi
            </a>
        </div> --}}
    </div>
</div>
@endsection
