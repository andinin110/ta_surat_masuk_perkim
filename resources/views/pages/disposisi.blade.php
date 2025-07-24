@extends('layouts.admin')

@section('title')
    Disposisi
@endsection

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Tabel Data Disposisi</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="mt-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Surat</th>
                                <th>Bidang</th>
                                <th>Eviden</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disposisi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->surat->nomor_surat }}</td>
                                    <td>{{ $item->bidang->name }}</td>
                                    <td>
                                        @if ($item->eviden)
                                            <a href="{{ asset('storage/' . $item->eviden) }}" target="_blank">Lihat File</a>
                                        @else
                                            No file
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Belum Diproses')
                                            <span class="badge bg-danger text-white">{{ $item->status }}</span>
                                        @else
                                            <span class="badge bg-success text-white">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <form action="{{ route('disposisi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus disposisi ini?')">
                                                <i class="fas fa-trash"></i>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title mb-0" id="addModalLabel">Tambah Data Disposisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="suratAdd" class="form-label">Surat</label>
                            <select class="form-control" name="surat" id="suratAdd" required>
                                <option value="" disabled selected>Pilih Surat</option>
                                @foreach ($surats as $surat)
                                    <option value="{{ $surat->id }}" data-qrlink="{{ route('disposisi.qrcode', $surat->id) }}">
                                        {{ $surat->nomor_surat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="qrcodeButton" style="display: none;">
                            <a href="#" id="qrLink" class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-qrcode"></i> Lihat QR
                            </a>
                        </div>

                        <div class="mb-3">
                            <label for="bidangAdd" class="form-label">Bidang</label>
                            <select class="form-control" name="bidang" id="bidangAdd" required>
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="eviden" class="form-label">Eviden</label>
                            <input type="file" class="form-control" name="eviden" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    @foreach ($disposisi as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h5 class="modal-title mb-0" id="editModalLabel{{ $item->id }}">Edit Data Disposisi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('disposisi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="suratEdit{{ $item->id }}" class="form-label">Surat</label>
                                <select class="form-control" name="surat" id="suratEdit{{ $item->id }}" required>
                                    @foreach ($surats as $surat)
                                        <option value="{{ $surat->id }}" {{ $item->surat_id == $surat->id ? 'selected' : '' }}>
                                            {{ $surat->nomor_surat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="bidangEdit{{ $item->id }}" class="form-label">Bidang</label>
                                <select class="form-control" name="bidang" id="bidangEdit{{ $item->id }}" required>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}" {{ $item->bidang_id == $bidang->id ? 'selected' : '' }}>
                                            {{ $bidang->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="evidenEdit{{ $item->id }}" class="form-label">Eviden</label>
                                <input type="file" class="form-control" name="eviden">
                                @if ($item->eviden)
                                    <small class="form-text text-muted">File saat ini:
                                        <a href="{{ asset('storage/' . $item->eviden) }}" target="_blank">Lihat</a>
                                    </small>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="statusEdit{{ $item->id }}" class="form-label">Status</label>
                                <select name="status" class="form-control" id="statusEdit{{ $item->id }}" required>
                                    <option value="Belum Diproses" {{ $item->status == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                    <option value="Sudah Diproses" {{ $item->status == 'Sudah Diproses' ? 'selected' : '' }}>Sudah Diproses</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const suratSelect = document.getElementById('suratAdd');
            const qrButton = document.getElementById('qrcodeButton');
            const qrLink = document.getElementById('qrLink');

            if (suratSelect && qrButton && qrLink) {
                suratSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const qrHref = selectedOption.getAttribute('data-qrlink');

                    if (qrHref) {
                        qrLink.href = qrHref;
                        qrButton.style.display = 'block';
                    } else {
                        qrButton.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
