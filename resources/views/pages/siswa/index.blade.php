<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        test siswa
    </h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="nav-link text-white font-weight-bold px-0">
            <i class="fa fa-sign-out-alt me-sm-1"></i>
            <span class="d-sm-inline d-none text-white">Keluar</span>
        </button>
    </form>
</body>

</html>