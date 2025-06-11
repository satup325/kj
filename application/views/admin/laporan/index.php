<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
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

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 1rem;
            padding: 1rem;
            color: #fff;
        }

        .table thead {
            color: #fff;
        }

        .btn-add {
            background-color: #fff;
            color: #0072ff;
            border: none;
            font-weight: 600;
        }

        .btn-add:hover {
            background-color: #f0f0f0;
            color: #0072ff;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
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
        <a href="<?= site_url('admin/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
        <a href="<?= site_url('admin/produk') ?>"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('admin/user') ?>"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>" class="active"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4"><i class="bi bi-bar-chart-fill"></i> Laporan Transaksi</h3>

        <div class="glass-card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-white">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Total (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)) : ?>
                            <?php $no = 1;
                            foreach ($transaksi as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($row->tanggal)) ?></td>
                                    <td><?= $row->nama_produk ?></td>
                                    <td class="text-center"><?= $row->jumlah ?></td>
                                    <td>Rp <?= number_format($row->total, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('admin/transaksi/detail/' . $row->id_transaksi) ?>" class="btn btn-sm btn-light">Detail</a>
                                        <a href="<?= site_url('admin/transaksi/cetak/' . $row->id_transaksi) ?>" class="btn btn-sm btn-success" target="_blank"><i class="bi bi-printer"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>