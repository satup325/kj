<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
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

        .glass-table thead a {
            color: #ffffff !important;
            text-decoration: none;
        }

        .glass-table thead a:hover {
            text-decoration: underline;
            color: #ffffff !important;
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

            .pagination {
                justify-content: center !important;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="<?= site_url('admin/dashboard') ?>"><i class="bi bi-house-door me-2"></i>Dashboard</a>
        <a href="<?= site_url('admin/produk') ?>" class="active"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('admin/user') ?>"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4"><i class="bi bi-box-seam"></i> Kelola Produk</h3>

        <div class="glass-card d-flex justify-content-between align-items-center mb-3">
            <a href="<?= site_url('admin/produk/tambah') ?>" class="btn btn-add"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
            <form method="get" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="Cari produk..." value="<?= $q ?>">
                <?php if ($sort): ?>
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                    <input type="hidden" name="order" value="<?= $order ?>">
                <?php endif; ?>
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline-light"><i class="bi bi-x-circle"></i></a>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <?php
                $entries = isset($_GET['entries']) ? (int) $_GET['entries'] : 5;
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $total_produk = count($produk);
                $total_pages = ceil($total_produk / $entries);
                $start = ($page - 1) * $entries;
                $filtered_produk = array_slice($produk, $start, $entries);
                ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="get" class="d-flex align-items-center gap-2">
                        <label for="entries" class="form-label mb-0 me-2 text-white">Tampilkan</label>
                        <select name="entries" id="entries" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <?php foreach ([5, 10, 25, 50, 100] as $opt) : ?>
                                <option value="<?= $opt ?>" <?= $entries === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="ms-2 text-white">entri</span>

                        <!-- Pertahankan nilai pencarian, sort, order -->
                        <input type="hidden" name="q" value="<?= $q ?>">
                        <input type="hidden" name="sort" value="<?= $sort ?>">
                        <input type="hidden" name="order" value="<?= $order ?>">
                        <input type="hidden" name="page" value="<?= $page ?>">
                    </form>
                </div>


                <table class="glass-table">
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
                        <?php $no = $start + 1;
                        foreach ($filtered_produk as $row): ?>

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
                                    <a href="<?= site_url('admin/produk/edit/' . $row->id_produk) ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square text-li"></i>
                                    </a>
                                    <a href="<?= site_url('admin/produk/hapus/' . $row->id_produk) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav class="w-100 text-center mt-4">
                    <ul class="pagination justify-content-center">
                        <?php
                        $base_url = site_url("admin/produk") . "?entries=$entries&q=" . urlencode($q) . "&sort=$sort&order=$order";

                        // Tombol Previous
                        $prev_page = max(1, $page - 1);
                        $disabled_prev = $page <= 1 ? 'disabled' : '';
                        ?>
                        <li class="page-item <?= $disabled_prev ?>">
                            <a class="page-link" href="<?= $base_url ?>&page=<?= $prev_page ?>" tabindex="-1">&laquo;</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php
                        // Tombol Next
                        $next_page = min($total_pages, $page + 1);
                        $disabled_next = $page >= $total_pages ? 'disabled' : '';
                        ?>
                        <li class="page-item <?= $disabled_next ?>">
                            <a class="page-link" href="<?= $base_url ?>&page=<?= $next_page ?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</body>

</html>