@extends('layouts.admin')
@section('title')
    Sub Bidang
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Data Sub bidang</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Sub bidang</h6>
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

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sub Bidang</th>
                            <th>Bidang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_bidang as $sub_bidang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sub_bidang->name }}</td>
                                <td>{{ $sub_bidang->bidang->name }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $sub_bidang->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('sub_bidang.destroy', $sub_bidang->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus sub bidang ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $sub_bidang->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $sub_bidang->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $sub_bidang->id }}">Edit Sub Bidang
                                            </h5>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('sub_bidang.update', $sub_bidang->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name', $sub_bidang->name) }}"
                                                        required>
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_bidang" class="form-label">Bidang</label>
                                                    <select class="form-control @error('id_bidang') is-invalid @enderror"
                                                        name="id_bidang" id="id_bidang" required>
                                                        <option value="" disabled>Pilih Bidang</option>
                                                        @foreach ($bidangs as $bidang)
                                                            <option value="{{ $bidang->id }}"
                                                                {{ old('id_bidang', $sub_bidang->id_bidang) == $bidang->id ? 'selected' : '' }}>
                                                                {{ $bidang->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_bidang')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
    <!-- /.container-fluid -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Sub Bidang</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sub_bidang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Masukkan Nama Sub Bidang" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_bidang" class="form-label">Bidang</label>
                            <select class="form-control @error('id_bidang') is-invalid @enderror" name="id_bidang"
                                id="id_bidang" required>
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}"
                                        {{ old('id_bidang') == $bidang->id ? 'selected' : '' }}>
                                        {{ $bidang->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_bidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
