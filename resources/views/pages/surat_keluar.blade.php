@extends('layouts.admin')

@section('title', 'Surat Keluar')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tabel Data Surat Keluar</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Surat Keluar</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dikirim Melalui</th>
                                <th>Jenis Naskah</th>
                                <th>Sifat Naskah</th>
                                <th>Klasifikasi</th>
                                <th>Hal</th>
                                <th>Isi Ringkasan</th>
                                <th>Tujuan</th>
                                <th>Verifikator</th>
                                <th>Tanggal Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->dikirim_melalui }}</td>
                                    <td>{{ $item->jenis_naskah }}</td>
                                    <td>{{ $item->sifat_naskah }}</td>
                                    <td>{{ $item->klasifikasi }}</td>
                                    <td>{{ $item->hal }}</td>
                                    <td>{{ $item->isi_ringkasan }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->verifikator }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('surat-keluar.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('surat-keluar.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus surat ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Surat Keluar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('surat-keluar.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Surat Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body row">
                        @php
                            $fields = [
                                'dikirim_melalui' => 'Dikirim Melalui',
                                'jenis_naskah' => 'Jenis Naskah',
                                'sifat_naskah' => 'Sifat Naskah',
                                'klasifikasi' => 'Klasifikasi',
                                'hal' => 'Hal',
                                'isi_ringkasan' => 'Isi Ringkasan',
                                'tujuan' => 'Tujuan',
                                'verifikator' => 'Verifikator'
                            ];
                        @endphp

                        @foreach ($fields as $name => $label)
                            <div class="form-group col-md-6">
                                <label for="{{ $name }}">{{ $label }}</label>
                                <input type="text" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
                                       value="{{ old($name) }}" required>
                                @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        <div class="form-group col-md-6">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                   value="{{ old('tanggal_keluar') }}" required>
                            @error('tanggal_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
