<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sertifikasi BNSP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }

        .hero-section {
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
            padding: 5rem 0 4rem;
        }

        .feature-card {
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .icon-box {
            width: 3.5rem;
            height: 3.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
        }

        
    </style>
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
                <div class="col-9 text-end">
                    <a href="/bnsp/login" class="btn btn-primary px-4 py-2">Masuk / Daftar</a>
                </div>

            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">     
                    <h1 class="display-5 fw-extrabold text-dark mb-3">
                        Portal Uji Sertifikasi & <br> <span class="text-primary">Kompetensi Profesi</span>
                    </h1>
                    <p class="lead text-muted mb-4 fs-6">
                        Platform digital pengelolaan data peserta sertifikasi kompetensi. Daftarkan diri Anda, pilih
                        skema keahlian yang terverifikasi, dan raih sertifikasi resmi yang diakui secara nasional.
                    </p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="icon-box bg-primary-subtle text-primary mb-3 fs-3">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Skema Terstandar</h5>
                        <p class="text-muted small mb-0">
                            Pilihan skema uji kompetensi yang telah divalidasi sesuai dengan Standar Kompetensi Kerja Nasional Indonesia (SKKNI).
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="icon-box bg-success-subtle text-success mb-3 fs-3">
                            <i class="bi bi-person-vcard-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Data Terintegrasi</h5>
                        <p class="text-muted small mb-0">
                            Pengelolaan biodata peserta, NISN, serta kelengkapan dokumen persyaratan sertifikasi secara digital, aman, dan transparan.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="icon-box bg-warning-subtle text-warning mb-3 fs-3">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Validasi & Verifikasi</h5>
                        <p class="text-muted small mb-0">
                            Memudahkan asesor dan admin dalam memverifikasi data kelayakan peserta sebelum asesmen dan penerbitan sertifikat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>