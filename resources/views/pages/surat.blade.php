@extends('layouts.admin')
@section('title')
    Surat
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Data surat</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data surat</h6>
                <div class="mt-3">
                    <!-- Tombol Tambah Data -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Sifat Surat</th>
                                <th>Isi Ringkasan</th>
                                <th>Asal Surat</th>
                                <th>Tujuan</th>
                                <th>Tanggal Terima Surat</th>
                                <th>Waktu Terima Surat</th>
                                <th>Batas Berakhir Surat</th>
                                <th>Waktu Berakhir Surat</th>
                                <th>Catatan</th>
                                <th>Eviden</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->sifat_surat }}</td>
                                    <td>{{ $surat->isi_ringkasan }}</td>
                                    <td>{{ $surat->dari }}</td>
                                    <td>{{ $surat->kepada }}</td>
                                    <td>{{ $surat->tanggal_terima->format('d-m-Y H:i') }}</td>
                                    <td>{{ $surat->tanggal_terima->format('H:i') }}</td>
                                    <td>{{ $surat->tanggal_berakhir->format('Y-m-d') }}</td>
                                    <td>{{ $surat->tanggal_berakhir->format('H:i') }}</td>
                                    <td>{{ $surat->catatan }}</td>
                                    <td>
                                        @if ($surat->disposisi && $surat->disposisi->eviden)
                                        <span class="">
                                            <a href="{{ asset('storage/' . $surat->disposisi->eviden) }}"
                                                target="_blank">Lihat File</a>
                                        </span>
                                    @else
                                        <span class="badge badge-danger">Tidak Ada</span>
                                    @endif
                                    </td>

                                    <td>
                                        <!-- Tombol Edit dengan ikon pencil -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $surat->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <!-- Tombol Hapus dengan ikon trash -->
                                        <form action="{{ route('surat.destroy', $surat->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus surat ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $surat->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $surat->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $surat->id }}">Edit Data
                                                    Surat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('surat.update', $surat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') <!-- Menggunakan method PUT untuk update -->
                                                <div class="modal-body">

                                                    <!-- Input untuk Nomor Surat -->
                                                    <div class="mb-3">
                                                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                                        <input type="text" class="form-control" name="nomor_surat"
                                                            value="{{ old('nomor_surat', $surat->nomor_surat) }}"
                                                            placeholder="Masukkan Nomor Surat" required>
                                                    </div>

                                                    <!-- Input untuk Sifat Surat -->
                                                    <div class="mb-3">
                                                        <label for="sifat_surat" class="form-label">Sifat Surat</label>
                                                        <input type="text" class="form-control" name="sifat_surat"
                                                            value="{{ old('sifat_surat', $surat->sifat_surat) }}"
                                                            placeholder="Masukkan Sifat Surat" required>
                                                    </div>

                                                    <!-- Input untuk Isi Ringkasan -->
                                                    <div class="mb-3">
                                                        <label for="isi_ringkasan" class="form-label">Isi Ringkasan</label>
                                                        <input type="text" class="form-control" name="isi_ringkasan"
                                                            value="{{ old('isi_ringkasan', $surat->isi_ringkasan) }}"
                                                            placeholder="Masukkan Isi Ringkasan Surat" required>
                                                    </div>

                                                    <!-- Input untuk Dari -->
                                                    <div class="mb-3">
                                                        <label for="dari" class="form-label">Dari</label>
                                                        <input type="text" class="form-control" name="dari"
                                                            value="{{ old('dari', $surat->dari) }}"
                                                            placeholder="Masukkan Dari" required>
                                                    </div>

                                                    <!-- Input untuk Kepada -->
                                                    <div class="mb-3">
                                                        <label for="kepada" class="form-label">Kepada</label>
                                                        <input type="text" class="form-control" name="kepada"
                                                            value="{{ old('kepada', $surat->kepada) }}"
                                                            placeholder="Masukkan Kepada" required>
                                                    </div>

                                                    <!-- Input untuk Tanggal Terima -->
                                                    <div class="mb-3">
                                                        <label for="tanggal_terima" class="form-label">Tanggal Berakhir</label>
                                                        <input type="datetime-local" class="form-control" name="tanggal_terima" value="{{ old('tanggal_terima', $surat->tanggal_terima ? $surat->tanggal_terima->format('Y-m-d\TH:i') : '') }}" required>
                                                    </div>


                                                    <!-- Input untuk Tanggal Berakhir -->
                                                    <div class="mb-3">
                                                        <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                                        <input type="datetime-local" class="form-control" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', $surat->tanggal_berakhir ? $surat->tanggal_berakhir->format('Y-m-d\TH:i') : '') }}" required>
                                                    </div>


                                                    <!-- Input untuk Catatan -->
                                                    <div class="mb-3">
                                                        <label for="catatan" class="form-label">Catatan</label>
                                                        <input type="text" class="form-control" name="catatan"
                                                            value="{{ old('catatan', $surat->catatan) }}"
                                                            placeholder="Masukkan Catatan" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('surat.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Input untuk Nomor Surat -->
                        <div class="mb-3">
                            <label for="no" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" name="nomor_surat"
                                placeholder="Masukkan Nomor Surat" required>
                        </div>

                        <!-- Input untuk Sifat Surat -->
                        <div class="mb-3">
                            <label for="sifat_surat" class="form-label">Sifat Surat</label>
                            <input type="text" class="form-control" name="sifat_surat"
                                placeholder="Masukkan Sifat Surat" required>
                        </div>

                        <!-- Input untuk Isi Ringkasan -->
                        <div class="mb-3">
                            <label for="isi_ringkasan" class="form-label">Isi Ringkasan</label>
                            <input type="text" class="form-control" name="isi_ringkasan"
                                placeholder="Masukkan Isi Ringkasan Surat" required>
                        </div>

                        <!-- Input untuk Dari -->
                        <div class="mb-3">
                            <label for="dari" class="form-label">Dari</label>
                            <input type="text" class="form-control" name="dari" placeholder="Masukkan Dari"
                                required>
                        </div>

                        <!-- Input untuk Kepada -->
                        <div class="mb-3">
                            <label for="kepada" class="form-label">Kepada</label>
                            <input type="text" class="form-control" name="kepada" placeholder="Masukkan Kepada"
                                required>
                        </div>

                        <!-- Input untuk Hal -->

                        <!-- Input untuk Tujuan -->

                         <!-- Input untuk Tanggal Terima -->
                         <div class="mb-3">
                            <label for="tanggal_terima" class="form-label">Tanggal Berakhir</label>
                            <input type="datetime-local" class="form-control" name="tanggal_terima" }}" required>
                        </div>


                        <!-- Input untuk Tanggal Berakhir -->
                        <div class="mb-3">
                            <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                            <input type="datetime-local" class="form-control" name="tanggal_berakhir" }}" required>
                        </div>

                        <!-- Input untuk Catatan -->
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input type="text" class="form-control" name="catatan" placeholder="Masukkan Catatan"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
