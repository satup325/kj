<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
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
            margin-bottom: 1rem;
            color: #fff;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 5px;
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
        <a href="<?= site_url('user/dashboard') ?>"><i class="bi bi-house-door me-2"></i>Dashboard</a>
        <a href="<?= site_url('user/produk') ?>"><i class="bi bi-box-seam me-2"></i>Produk</a>
        <a href="<?= site_url('user/keranjang') ?>" class="active"><i class="bi bi-cart4 me-2"></i>Keranjang</a>
        <a href="<?= site_url('user/selesai') ?>"><i class="bi bi-check-circle me-2"></i>Selesai</a>
        <a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="mb-4"><i class="bi bi-cart"></i> Keranjang Belanja</h3>

            <?php if (empty($keranjang)) : ?>
                <div class="alert alert-warning text-white card-glass">
                    <i class="bi bi-exclamation-circle color"></i> Keranjang kamu kosong.
                </div>
            <?php else : ?>
                <?php foreach ($keranjang as $item) : ?>
                    <div class="card-glass d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url('assets/images/produk/' . $item->gambar) ?>" class="product-img me-3" alt="<?= $item->nama_produk ?>">
                            <div>
                                <h6 class="mb-1"><?= $item->nama_produk ?></h6>
                                <small>Jumlah: <?= $item->jumlah ?></small><br>
                                <small>Harga: Rp<?= number_format($item->harga_jual, 0, ',', '.') ?></small>
                            </div>
                        </div>
                        <div>
                            <a href="<?= site_url('user/keranjang/hapus/' . $item->id_keranjang) ?>" class="btn btn-sm btn-danger rounded-pill"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-end mt-4">
                    <a href="<?= site_url('user/keranjang/checkout') ?>" class="btn btn-light rounded-pill">
                        <i class="bi bi-bag-check"></i> Checkout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>