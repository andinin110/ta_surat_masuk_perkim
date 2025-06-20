@extends('layouts.login')
@section('title')
Login
@endsection
@section('content')
<style>
    /* Menambahkan gaya untuk container row agar form berada di tengah */
.row.justify-content-center {
    height: 100vh; /* Membuat row mengisi tinggi layar */
    display: flex;
    justify-content: center; /* Menyusun form secara horizontal di tengah */
    align-items: center; /* Menyusun form secara vertikal di tengah */
}

/* Menambahkan gaya untuk card agar transparan */
.card {
    background-color: rgba(255, 255, 255, 0.8); /* Memberikan transparansi pada latar belakang card */
    border-radius: 10px; /* Memberikan border-radius agar sudut lebih halus */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Memberikan sedikit bayangan agar card lebih menonjol */
}

/* Menambahkan beberapa padding dan gaya tambahan pada form */
.form-group input {
    border-radius: 5px;
    padding: 10px;
}

/* Menambahkan styling tombol login */
.btn-user {
    border-radius: 5px;
}

</style>
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-1 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Aplikasi Surat Masuk</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="nip" class="form-control form-control-user @error('nip') is-invalid @enderror"
                                    id="exampleInputEmail" name="nip" value="{{ old('nip') }}" aria-describedby="emailHelp"
                                    placeholder="Enter nip Address...">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword" name="password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
