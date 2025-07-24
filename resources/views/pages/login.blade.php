<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login Aplikasi Surat Menyurat">
    <meta name="author" content="">

    <title>@yield('title', 'Login - Aplikasi Surat Menyurat')</title>

    @include('includes.style')

    <style>
        body {
           margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('{{ asset('storage/background/ilustrasi.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .container-login {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            padding: 2rem;
        }

        .login-left {
            flex: 1;
            padding: 2rem;
        }

        .login-left img {
            width: 100%;
            max-width: 500px;
        }

        .login-right {
            flex: 1;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-left: auto;
        }

        .login-right h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .login-right p {
            margin-bottom: 2rem;
            color: #555;
        }

        .login-right input[type="text"],
        .login-right input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .login-right button {
            width: 100%;
            padding: 0.8rem;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
        }

        .login-right .small-text {
            font-size: 0.85rem;
            margin-top: 1rem;
            color: #777;
        }

        .logo {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo img {
            max-height: 60px;
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="login-left">
            {{-- <img src="{{ asset('storage/background/ilustrasi.png') }}" alt="Ilustrasi Surat"> --}}
        </div>
        <div class="login-right">
            <div class="logo">
                <img src="{{ asset('img/logo-dinas.png') }}" alt="Logo Dinas">
            </div>
            <h1>Selamat Datang di Aplikasi Surat Menyurat</h1>
            <p>Dinas Perumahan Rakyat dan Kawasan Permukiman Provinsi Kalimantan Barat</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" class="form-control form-control-user @error('nip') is-invalid @enderror"
                                    id="exampleInputEmail" name="nip" value="{{ old('nip') }}" aria-describedby="emailHelp"
                                    placeholder="Enter nip Address...">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword" name="password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <button type="submit">Masuk</button>
            </form>
            <div class="small-text">
                <a href="{{ route('password.request') }}">Lupa Password?</a>
                <p>Aplikasi internal untuk pengelolaan surat masuk dan keluar, khusus Dinas Perkim Prov. Kalimantan Barat.</p>
            </div>
        </div>
    </div>

    @include('includes.script')
</body>

</html>
