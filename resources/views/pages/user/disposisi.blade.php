@extends('layouts.user')
@section('title')
    Disposisi
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Data Disposisi</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data disposisi</h6>

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
                                <th>Tanggal Terima Surat</th>
                                <th>Waktu Terima Surat</th>
                                <th>Batas Berakhir Surat</th>
                                <th>Waktu Berakhir Surat</th>
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

                                    <td>{{ $item->surat->tanggal_terima->format('d-m-Y H:i') }}</td>
                                    <td>{{ $item->surat->tanggal_terima->format('H:i') }}</td>
                                    <td>{{ $item->surat->tanggal_berakhir->format('Y-m-d') }}</td>
                                    <td>{{ $item->surat->tanggal_berakhir->format('H:i') }}</td>

                                    <td>
                                        @if ($item->status == 'Belum Diproses')
                                            <span class="badge bg-danger text-white">{{ $item->status }}</span>
                                        @else
                                            <span class="badge bg-success text-white">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Sudah Selesai')
                                            <!-- Tampilkan teks jika status sudah selesai -->
                                            <span class="badge bg-success text-white">Selesai</span>
                                        @else
                                            <!-- Tampilkan tombol jika status belum selesai -->
                                            <form action="{{ route('disposisi.updateStatus', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    @if ($item->status == 'Belum Diproses')
                                                        <i>Proses</i>
                                                    @elseif ($item->status == 'Proses')
                                                        <i>Selesaikan</i>
                                                    @endif
                                                </button>
                                            </form>
                                        @endif
                                    </td>


                                </tr>



                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    <!-- Bootstrap JS dan Popper.js harus diletakkan setelah jQuery dan CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endsection
