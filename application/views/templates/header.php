<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Kantin Kejujuran' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .navbar-glass .nav-link,
        .navbar-brand {
            color: #fff !important;
        }

        .navbar-glass .nav-link:hover {
            color: #f0f0f0 !important;
        }

        .content {
            min-height: 80vh;
            padding: 2rem;
        }
    </style>
</head>

<body>

    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('dashboard') ?>"><i class="bi bi-shop"></i> Kantin Kejujuran</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('produk') ?>">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('user') ?>">User</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Start of content -->
    <div class="content container-fluid">