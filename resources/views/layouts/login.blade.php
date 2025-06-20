<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    @include('includes.style')


</head>
<style>
    .login-background {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/perkim.jpg') }}');
        background-size: cover;
    }

</style>
<body class="login-background">



        <!-- Outer Row -->
        @yield('content')



   @include('includes.script')

</body>

</html>
