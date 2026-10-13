<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #ffffff;">
    <nav class="navbar bg-white border-bottom py-2">
        <div class="container-fluid">
            <div class="row w-100 align-items-center mx-0">
                <div class="col-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('bnsp.png') }}" alt="Logo" style="height: 6rem;">
                    </a>
                </div>
                <div class="col-6 text-center">
                    <span class="fw-bold fs-5">Aplikasi Pengelolaan Data Peserta Sertifikasi</span>
                </div>
                <div class="col-3 text-end">
                    <a href="/admin/login" class="btn btn-primary px-4 py-2">Login</a>
                </div>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>