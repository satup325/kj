<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
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
        <a href="<?= site_url('admin/user') ?>" class="active"><i class="bi bi-people-fill me-2"></i>User</a>
        <a href="<?= site_url('admin/laporan') ?>"><i class="bi bi-bar-chart-fill me-2"></i>Laporan</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4"><i class="bi bi-people-fill"></i> Kelola User</h3>

        <div class="glass-card d-flex justify-content-between align-items-center mb-3">
            <a href="<?= site_url('admin/user/tambah') ?>" class="btn btn-add"><i class="bi bi-plus-circle"></i> Tambah User</a>
            <form class="d-flex gap-2" method="get" action="<?= site_url('admin/user') ?>">
                <input class="form-control me-2" type="search" name="q" placeholder="Cari user..." value="<?= html_escape($this->input->get('q')) ?>" style="max-width: 250px;">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                <a href="<?= site_url('admin/user') ?>" class="btn btn-outline-light"><i class="bi bi-x-circle"></i></a>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <?php
                $entries = isset($_GET['entries']) ? (int) $_GET['entries'] : 5;
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $total_users = $total_pages * $entries;
                $q = isset($_GET['q']) ? $_GET['q'] : '';
                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                $order = isset($_GET['order']) ? $_GET['order'] : '';

                $total_pages = ceil($total_users / $entries);
                $start = ($page - 1) * $entries;
                $filtered_users = $users;
                ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="get" class="d-flex align-items-center mb-3">
                        <label class="me-2 text-white">Tampilkan</label>
                        <select name="entries" class="form-select form-select-sm me-2" onchange="this.form.submit()" style="width: auto;">
                            <?php foreach ([5, 10, 25, 50] as $opt) : ?>
                                <option value="<?= $opt ?>" <?= $entries == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="text-white">entri</label>
                        <input type="hidden" name="q" value="<?= html_escape($this->input->get('q')) ?>">
                        <input type="hidden" name="sort" value="<?= html_escape($this->input->get('sort')) ?>">
                        <input type="hidden" name="order" value="<?= html_escape($this->input->get('order')) ?>">
                    </form>
                </div>
                <table class="glass-table">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>
                                <a href="<?= site_url('admin/user?q=' . urlencode($this->input->get('q')) . '&sort=username&order=' . ($sort == 'username' && $order == 'asc' ? 'desc' : 'asc')) ?>" class="text-white text-decoration-none">
                                    Username <?= $sort == 'username' ? ($order == 'asc' ? '▲' : '▼') : '' ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= site_url('admin/user?q=' . urlencode($this->input->get('q')) . '&sort=email&order=' . ($sort === 'email' && $order === 'asc' ? 'desc' : 'asc')) ?>" class="text-white text-decoration-none">
                                    Email <?= $sort == 'email' ? ($order == 'asc' ? '▲' : '▼') : '' ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= site_url('admin/user?q=' . urlencode($this->input->get('q')) . '&sort=role&order=' . ($sort === 'role' && $order === 'asc' ? 'desc' : 'asc')) ?>" class="text-white text-decoration-none">
                                    Role <?= $sort == 'role' ? ($order == 'asc' ? '▲' : '▼') : '' ?>
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $start + 1;
                        foreach ($filtered_users as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $row->username ?></td>
                                <td><?= $row->email ?></td>
                                <td class="text-center"><?= ucfirst($row->role) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/user/edit/' . $row->id_akun) ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square text-li"></i></a>
                                    <a href="<?= site_url('admin/user/hapus/' . $row->id_akun) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($filtered_users)) : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data user.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
                <nav class="w-100 text-center mt-4">
                    <ul class="pagination justify-content-center">
                        <?php
                        $base_url = site_url("admin/user") . "?entries=$entries&q=" . urlencode($q) . "&sort=$sort&order=$order";
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