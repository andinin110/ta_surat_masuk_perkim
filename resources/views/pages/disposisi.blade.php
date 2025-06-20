@extends('layouts.admin')
@section('title')
    Disposisi
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Data disposisi</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data disposisi</h6>
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
                                            <!-- Menampilkan link "Lihat File" jika file ada -->
                                            <a href="{{ asset('storage/' . $item->eviden) }}" target="_blank">Lihat File</a>
                                        @else
                                            <!-- Jika file tidak ada, menampilkan teks 'No file' -->
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
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('disposisi.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus disposisi ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <!-- Edit Modal -->
                                {{-- <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data Disposisi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('disposisi.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <!-- Pilih Surat -->
                                                    <div class="mb-3">
                                                        <label for="surat" class="form-label">Surat</label>
                                                        <select class="form-control" name="surat" id="surat" required>
                                                            <option value="" disabled>Pilih Surat</option>
                                                            @foreach ($surats as $surat)
                                                                <option value="{{ $surat->id }}"
                                                                    {{ $surat->id == $item->id_surat ? 'selected' : '' }}>
                                                                    {{ $surat->nomor_surat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Input untuk Eviden -->
                                                    <div class="mb-3">
                                                        <label for="eviden" class="form-label">Eviden</label>
                                                        <input type="file" class="form-control" name="eviden">
                                                        @if ($item->eviden)
                                                            <small class="text-muted">File saat ini:
                                                                {{ basename($item->eviden) }}</small>
                                                        @endif
                                                    </div>

                                                    <!-- Select untuk Bidang -->
                                                    <div class="mb-3">
                                                        <label for="bidang" class="form-label">Bidang</label>
                                                        <select class="form-control" name="bidang"
                                                            id="bidangEdit{{ $item->id }}" required>
                                                            <option value="" disabled>Pilih Bidang</option>
                                                            @foreach ($bidangs as $bidang)
                                                                <option value="{{ $bidang->id }}"
                                                                    {{ $bidang->id == $item->id_bidang ? 'selected' : '' }}>
                                                                    {{ $bidang->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Sub Bidang -->
                                                    <div class="mb-3">
                                                        <label for="sub_bidang" class="form-label">Sub Bidang</label>
                                                        <select class="form-control" name="sub_bidang"
                                                            id="sub_bidangEdit{{ $item->id }}">
                                                            <option value="" disabled selected>Pilih Sub Bidang
                                                            </option>
                                                            @foreach ($bidangs as $bidang)
                                                                @if ($bidang->id == $item->id_bidang)
                                                                    @foreach ($bidang->subBidang as $subBidang)
                                                                        <option value="{{ $subBidang->id }}"
                                                                            {{ $subBidang->id == $item->id_sub_bidang ? 'selected' : '' }}>
                                                                            {{ $subBidang->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <!-- Select Status -->
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-control" name="status" id="status" required>
                                                            <option value="Belum Diproses"
                                                                {{ $item->status == 'Belum Diproses' ? 'selected' : '' }}>
                                                                Belum Diproses</option>
                                                            <option value="Sedang Diproses"
                                                                {{ $item->status == 'Sedang Diproses' ? 'selected' : '' }}>
                                                                Sedang Diproses</option>
                                                            <option value="Selesai"
                                                                {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="modal fade" id="editModal{{ $item->id ?? '' }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id ?? '' }}" aria-hidden="true">
                                   <div class="modal-dialog">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="editModalLabel">Edit Data Disposisi</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                           </div>
                                           @isset($item)
                                               <form action="{{ route('disposisi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                   @csrf
                                                   @method('PUT')
                                                   <div class="modal-body">
                                                       <!-- Pilih Surat -->
                                                       <div class="mb-3">
                                                           <label for="surat" class="form-label">Surat</label>
                                                           <select class="form-control" name="surat" id="surat" required>
                                                               <option value="" disabled>Pilih Surat</option>
                                                               @foreach ($surats as $surat)
                                                                   <option value="{{ $surat->id }}"
                                                                           {{ $surat->id == $item->id_surat ? 'selected' : '' }}>
                                                                       {{ $surat->nomor_surat }}
                                                                   </option>
                                                               @endforeach
                                                           </select>
                                                       </div>

                                                       <!-- Input untuk Eviden -->
                                                       <div class="mb-3">
                                                           <label for="eviden" class="form-label">Eviden</label>
                                                           <input type="file" class="form-control" name="eviden">
                                                           @if ($item->eviden)
                                                               <small class="text-muted">File saat ini: {{ basename($item->eviden) }}</small>
                                                           @endif
                                                       </div>

                                                       <!-- Select untuk Bidang -->
                                                       <div class="mb-3">
                                                           <label for="bidang" class="form-label">Bidang</label>
                                                           <select class="form-control" name="bidang" id="bidangEdit{{ $item->id }}" required>
                                                               <option value="" disabled>Pilih Bidang</option>
                                                               @foreach ($bidangs as $bidang)
                                                                   <option value="{{ $bidang->id }}"
                                                                           {{ $bidang->id == $item->id_bidang ? 'selected' : '' }}>
                                                                       {{ $bidang->name }}
                                                                   </option>
                                                               @endforeach
                                                           </select>
                                                       </div>


                                                       <!-- Select Status -->
                                                       <div class="mb-3">
                                                           <label for="status" class="form-label">Status</label>
                                                           <select class="form-control" name="status" id="status" required>
                                                               <option value="Belum Diproses" {{ $item->status == 'Belum Diproses' ? 'selected' : '' }}>
                                                                   Belum Diproses
                                                               </option>
                                                               <option value="Sedang Diproses" {{ $item->status == 'Sedang Diproses' ? 'selected' : '' }}>
                                                                   Sedang Diproses
                                                               </option>
                                                               <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                       <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                   </div>
                                               </form>
                                           @endisset
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
    <!-- /.container-fluid -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Disposisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('disposisi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Pilih Surat -->
                        <div class="mb-3">
                            <label for="surat" class="form-label">Surat</label>
                            <select class="form-control" name="surat" id="surat" required>
                                <option value="" disabled selected>Pilih Surat</option>
                                @foreach ($surats as $surat)
                                    <option value="{{ $surat->id }}">{{ $surat->nomor_surat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <select class="form-control" name="bidang" id="bidangAdd" required>
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Upload Eviden -->
                        <div class="mb-3">
                            <label for="eviden" class="form-label">Eviden</label>
                            <input type="file" class="form-control" name="eviden" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bidangAddSelect = document.getElementById('bidangAdd');
            const subBidangAddSelect = document.getElementById('sub_bidangAdd');

            // Pastikan bidangAddSelect dan subBidangAddSelect ada
            if (!bidangAddSelect || !subBidangAddSelect) return;

            // Data Bidang dan Sub Bidang dari PHP
            const bidangs = @json($bidangs);

            // Fungsi untuk memperbarui sub-bidang berdasarkan bidang yang dipilih
            function updateSubBidangSelect(bidangId) {
                // Kosongkan dropdown sub_bidang terlebih dahulu
                subBidangAddSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Bidang</option>';

                const selectedBidang = bidangs.find(bidang => bidang.id == bidangId);

                if (selectedBidang && selectedBidang.sub_bidang.length > 0) {
                    // Jika Bidang memiliki Sub Bidang, tambahkan ke dropdown
                    selectedBidang.sub_bidang.forEach(subBidang => {
                        const option = document.createElement('option');
                        option.value = subBidang.id;
                        option.textContent = subBidang.name;
                        subBidangAddSelect.appendChild(option);
                    });
                } else {
                    // Jika Bidang tidak memiliki Sub Bidang, tampilkan opsi "Tidak ada Sub Bidang"
                    const option = document.createElement('option');
                    option.disabled = true;
                    option.textContent = 'Tidak ada Sub Bidang';
                    subBidangAddSelect.appendChild(option);
                }
            }

            // Menangani perubahan pada dropdown Bidang (Add)
            bidangAddSelect.addEventListener('change', function() {
                updateSubBidangSelect(this.value);
            });
        });
    </script>





    <!-- Bootstrap JS dan Popper.js harus diletakkan setelah jQuery dan CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endsection
