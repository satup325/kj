<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        html {
            height: auto;
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            color: #fff;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            height: 100vh;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            margin-left: 220px;
            padding: 2rem;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: 0.3s;
        }

        .card-glass:hover {
            transform: scale(1.03);
        }

        .table-container {
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        .glass-table {
            width: 100%;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            overflow: hidden;
            border-collapse: collapse;
        }

        .glass-table thead {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .glass-table th,
        .glass-table td {
            padding: 0.9rem 1rem;
            border: none;
            color: #ffffff;
        }

        .glass-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s;
        }

        .glass-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .glass-table td {
            font-weight: 300;
        }

        .table-container {
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: sticky;
                top: 0;
                z-index: 1030;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                padding: 0.5rem 0;
            }

            .sidebar a {
                padding: 8px 10px;
                font-size: 0.9rem;
            }

            .main-content {
                margin-left: 0;
                padding-top: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="<?= site_url('admin/dashboard') ?>" class="active"><i class="bi bi-house-door me-2"></i>Dashboard</a>
        <a href="<?= site_url('admin/produk') ?>"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('admin/user') ?>"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="mb-4"><i class="bi bi-house-door me-2"></i> Dashboard</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-glass">
                        <i class="bi bi-box-seam fs-1"></i>
                        <h5>Total Produk</h5>
                        <h3><?= $produk ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-glass">
                        <i class="bi bi-people-fill fs-1"></i>
                        <h5>Total Pengguna</h5>
                        <h3><?= $user ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-glass">
                        <i class="bi bi-receipt fs-1"></i>
                        <h5>Total Transaksi</h5>
                        <h3><?= $total_transaksi ?></h3>
                    </div>
                </div>
            </div>
            <?php if (!empty($stok_menipis)) : ?>
                <div class="mt-5">
                    <h5 class="mb-3 text-light">
                        <i class="text-warning bi bi-exclamation-triangle-fill me-2"></i>
                        Hampir Habis
                    </h5>

                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="glass-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($stok_menipis as $p) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $p->nama_produk ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">
                                                    <?= $p->stok ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>