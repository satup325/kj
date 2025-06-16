<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
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

        .btn-sm {
            padding: 0.3rem 0.6rem;
            font-size: 0.75rem;
            border-radius: 0.4rem;
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
        <a href="<?= site_url('admin/dashboard') ?>"><i class="bi bi-house-door me-2"></i>Dashboard</a>
        <a href="<?= site_url('admin/produk') ?>"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('admin/user') ?>"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>" class="active"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4"><i class="bi bi-bar-chart-fill"></i> Laporan Transaksi</h3>
        <div class="table-container">
            <div class="table-responsive">
                <?php
                // Ambil seluruh data laporan dari controller
                $all_laporan = $laporan; // simpan dulu semuanya

                $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $selected_periode = isset($_GET['periode']) ? $_GET['periode'] : '';

                $total_data = count($all_laporan);
                $total_pages = ceil($total_data / $limit);
                $start = ($page - 1) * $limit;
                $laporan = array_slice($all_laporan, $start, $limit); // hanya ambil data halaman saat ini
                ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="get" class="d-flex align-items-center gap-2 mb-3">
                        <label for="limit" class="mb-0">Tampilkan</label>
                        <select name="limit" id="limit" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <?php foreach ([5, 10, 25, 50, 100] as $val) : ?>
                                <option value="<?= $val ?>" <?= $limit == $val ? 'selected' : '' ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="mb-0">entri</label>

                        <input type="hidden" name="periode" value="<?= $selected_periode ?>">
                    </form>

                    <form method="get" class="mb-3 d-flex align-items-center gap-2">
                        <label for="periode" class="form-label mb-0">Filter:</label>
                        <select name="periode" id="periode" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="harian" <?= $selected_periode == 'harian' ? 'selected' : '' ?>>Harian</option>
                            <option value="mingguan" <?= $selected_periode == 'mingguan' ? 'selected' : '' ?>>Mingguan</option>
                            <option value="bulanan" <?= $selected_periode == 'bulanan' ? 'selected' : '' ?>>Bulanan</option>
                            <option value="tahunan" <?= $selected_periode == 'tahunan' ? 'selected' : '' ?>>Tahunan</option>
                        </select>
                    </form>

                    <!-- Cetak PDF -->
                    <a href="<?= site_url('admin/laporan/cetak_filter?periode=' . ($selected_periode ?? '')) ?>" target="_blank" class="btn btn-sm btn-success mb-3 ">
                        <i class="bi bi-printer"></i> Cetak PDF
                    </a>
                </div>

                <table class="glass-table">
                    <thead class="text-center">
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
                        <?php if (!empty($laporan)) : ?>
                            <?php $no = $start + 1;
                            foreach ($laporan as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($row->tanggal)) ?></td>
                                    <td><?= $row->nama_produk ?></td>
                                    <td class="text-center"><?= $row->jumlah ?></td>
                                    <td>Rp <?= number_format($row->subtotal, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('admin/laporan/detail/' . $row->id_transaksi) ?>" class="btn btn-sm btn-light">Detail</a>
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
                <nav class="w-100 text-center mt-4">
                    <ul class="pagination justify-content-center">
                        <?php
                        $base_url = site_url("admin/laporan") . "?limit=$limit&periode=" . urlencode($selected_periode);
                        $prev_page = max(1, $page - 1);
                        $next_page = min($total_pages, $page + 1);
                        ?>
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= $base_url ?>&page=<?= $prev_page ?>">&laquo;</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= $base_url ?>&page=<?= $next_page ?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>


</body>

</html>
