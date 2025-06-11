<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
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
        <a href="<?= site_url('admin/produk') ?>" class="active"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('admin/user') ?>"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4"><i class="bi bi-box-seam"></i> Kelola Produk</h3>

        <div class="glass-card mb-3">
            <a href="<?= site_url('admin/produk/tambah') ?>" class="btn btn-add"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0"><i class="bi bi-box-seam"></i> Daftar Produk</h4>

            <form method="get" class="d-flex gap-2 mb-3">
                <input type="text" name="q" class="form-control" placeholder="Cari produk..." value="<?= $q ?>">
                <?php if ($sort): ?>
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                    <input type="hidden" name="order" value="<?= $order ?>">
                <?php endif; ?>
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline-light"><i class="bi bi-x-circle"></i></a>
            </form>


        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <?php
                function sort_link($label, $field, $current_sort, $current_order, $q)
                {
                    $next_order = ($current_sort === $field && $current_order === 'asc') ? 'desc' : 'asc';
                    $icon = '';

                    if ($current_sort === $field) {
                        $icon = $current_order === 'asc' ? '▲' : '▼';
                    }

                    $url = site_url("admin/produk?q=" . urlencode($q) . "&sort=$field&order=$next_order");
                    return "<a href=\"$url\" class=\"text-black text-decoration-none\">$label $icon</a>";
                }
                ?>

                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th><?= sort_link('Nama Produk', 'nama_produk', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Jumlah Satuan Besar', 'jumlah_satuan_besar', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Isi', 'isi', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Harga Satuan Besar', 'harga_satuan_besar', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Harga Eceran', 'harga_eceran', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Harga Jual', 'harga_jual', $sort, $order, $q) ?></th>
                        <th><?= sort_link('Stok', 'stok', $sort, $order, $q) ?></th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($produk as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row->nama_produk ?></td>
                            <td class="text-center"><?= $row->jumlah_satuan_besar ?></td>
                            <td class="text-center"><?= $row->isi ?></td>
                            <td>Rp <?= number_format($row->harga_satuan_besar, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($row->harga_eceran, 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($row->harga_jual, 0, ',', '.') ?></td>
                            <td class="text-center"><?= $row->stok ?></td>
                            <td class="text-center">
                                <?php if (!empty($row->gambar)) : ?>
                                    <img src="<?= base_url('assets/images/produk/' . $row->gambar) ?>" alt="Gambar Produk" width="60" height="60" class="img-thumbnail">
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= site_url('admin/produk/edit/' . $row->id_produk) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= site_url('admin/produk/hapus/' . $row->id_produk) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</body>

</html>