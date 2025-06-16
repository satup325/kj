<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Daftar Produk</title>
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
			padding: 1rem;
			color: #fff;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
			height: 100%;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.card-glass:hover {
			transform: translateY(-5px);
			box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
		}

		.product-img {
			height: 180px;
			width: 100%;
			object-fit: contain;
			border-radius: 12px;
			background-color: rgba(255, 255, 255, 0.1);
			padding: 10px;
		}


		.btn-buy {
			border: none;
			background: rgba(255, 255, 255, 0.2);
			color: #fff;
			transition: background 0.3s;
		}

		.btn-buy:hover {
			background: rgba(255, 255, 255, 0.3);
			color: #000;
		}

		.btn-buy-now {
			background: linear-gradient(135deg, #ff8a00, #e52e71);
			color: #fff;
			border: none;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(229, 46, 113, 0.4);
		}

		.btn-buy-now:hover {
			background: linear-gradient(135deg, #e52e71, #ff8a00);
			color: #fff;
			transform: scale(1.05);
			box-shadow: 0 6px 20px rgba(229, 46, 113, 0.6);
		}

		.pagination .page-link {
			background: rgba(255, 255, 255, 0.15);
			border: none;
			margin: 0 3px;
			color: #fff;
			border-radius: 8px;
			transition: 0.3s ease;
		}

		.pagination .page-link:hover {
			background: rgba(255, 255, 255, 0.3);
			color: #000;
		}

		.pagination .active .page-link {
			background: rgba(255, 255, 255, 0.5);
			color: #000;
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
		<a href="<?= site_url('user/produk') ?>" class="active"><i class="bi bi-box-seam me-2"></i>Produk</a>
		<a href="<?= site_url('user/keranjang') ?>"><i class="bi bi-cart4 me-2"></i>Keranjang</a>
		<a href="<?= site_url('user/selesai') ?>"><i class="bi bi-check-circle me-2"></i>Selesai</a>
		<a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
	</div>

	<!-- Main Content -->
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="mb-4"><i class="bi bi-box-seam"></i> Daftar Produk</h3>
			<form method="get" action="<?= site_url('user/produk') ?>" class="d-flex justify-content-beetwen gap-2 mb-4">
				<div class="input-group">
					<input type="text" class="form-control rounded-start-pill" name="keyword" placeholder="Cari produk..." value="<?= html_escape($this->input->get('keyword')) ?>" style="background: rgba(255,255,255,0.2); color: #fff; border: none;">
					<button class="btn btn-light rounded-end-pill" type="submit"><i class="bi bi-search"></i></button>
				</div>
				<a href="<?= site_url('user/produk') ?>" class="btn btn-light"><i class="bi bi-x-circle"></i></a>
			</form>

			<form method="get" class="d-flex justify-content-between align-items-center mb-3">
				<div class="d-flex align-items-center">
					<label class="me-2 text-white">Tampilkan</label>
					<select name="limit" onchange="this.form.submit()" class="form-select d-inline-block w-auto"
						style="background: rgba(255,255,255,0.2); color: #000; border: none;">
						<?php foreach ([5, 10, 25, 50, 100] as $jml) : ?>
							<option value="<?= $jml ?>" <?= ($limit == $jml) ? 'selected' : '' ?>><?= $jml ?></option>
						<?php endforeach; ?>
					</select>
					<label class="ms-2 text-white">entri</label>
				</div>
				<input type="hidden" name="keyword" value="<?= html_escape($keyword) ?>">
			</form>

			<div class="row g-4">
				<?php if (empty($produk)) : ?>
					<div class="text-center text-white mt-4">
						<h5><i class="bi bi-emoji-frown"></i> Produk tidak ditemukan</h5>
					</div>
				<?php endif; ?>

				<?php foreach ($produk as $p) : ?>
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div class="card-glass p-3">
							<img src="<?= base_url('assets/images/produk/' . $p->gambar) ?>" class="product-img mb-3" alt="<?= $p->nama_produk ?>">
							<h5 class="fw-semibold"><?= $p->nama_produk ?></h5>
							<p class="mb-1">Harga: <strong>Rp<?= number_format($p->harga_jual, 0, ',', '.') ?></strong></p>
							<p class="mb-3">Stok: <?= $p->stok ?></p>
							<div class="d-grid gap-2">
								<button class="btn btn-buy btn-sm rounded-pill toggle-jumlah" type="button" data-target="jumlah-<?= $p->id_produk ?>">
									<i class="bi bi-cart-plus"></i> Tambah ke Keranjang
								</button>

								<form action="<?= site_url('user/keranjang/tambah') ?>" method="post" id="jumlah-<?= $p->id_produk ?>" class="jumlah-form mt-2 d-none">
									<input type="hidden" name="id_produk" value="<?= $p->id_produk ?>">
									<label for="jumlah">Jumlah</label>
									<input type="number" name="jumlah" value="1" min="1" max="<?= $p->stok ?>" class="form-control form-control-sm mb-2" style="border-radius: 20px; background: rgba(255,255,255,0.2); color: #fff; border: none;" required>
									<button type="submit" class="btn btn-buy btn-sm rounded-pill">
										<i class="bi bi-check-circle"></i> Konfirmasi
									</button>
								</form>

								<!-- Tombol Beli Sekarang tetap langsung -->
								<button class="btn btn-buy-now btn-sm rounded-pill mt-2 toggle-beli" type="button" data-target="beli-<?= $p->id_produk ?>">
									<i class="bi bi-cash-coin"></i> Beli Sekarang
								</button>
								<form action="<?= site_url('user/keranjang/beli_langsung') ?>" method="post" id="beli-<?= $p->id_produk ?>" class="beli-form mt-2 d-none">
									<input type="hidden" name="id_produk" value="<?= $p->id_produk ?>">
									<label for="jumlah">Jumlah</label>
									<input type="number" name="jumlah" value="1" min="1" max="<?= $p->stok ?>" class="form-control form-control-sm mb-2" style="border-radius: 20px; background: rgba(255,255,255,0.2); color: #fff; border: none;" required>
									<button type="submit" class="btn btn-buy-now btn-sm rounded-pill">
										<i class="bi bi-check-circle"></i> Konfirmasi Beli
									</button>
								</form>

							</div>

						</div>
					</div>
				<?php endforeach; ?>
				<?php if ($total_pages > 1) : ?>
	<nav class="mt-4 d-flex justify-content-center">
		<ul class="pagination">

			<!-- Tombol Previous -->
			<li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
				<a class="page-link"
					href="?limit=<?= $limit ?>&page=<?= ($page - 1) ?>&keyword=<?= urlencode($keyword) ?>"
					aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>

			<!-- Nomor Halaman -->
			<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
				<li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
					<a class="page-link"
						href="?limit=<?= $limit ?>&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>">
						<?= $i ?>
					</a>
				</li>
			<?php endfor; ?>

			<!-- Tombol Next -->
			<li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
				<a class="page-link"
					href="?limit=<?= $limit ?>&page=<?= ($page + 1) ?>&keyword=<?= urlencode($keyword) ?>"
					aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>

		</ul>
	</nav>
<?php endif; ?>
			</div>
		</div>
	</div>

	<script>
		document.querySelectorAll('.toggle-jumlah').forEach(function(btn) {
			btn.addEventListener('click', function() {
				const targetId = btn.getAttribute('data-target');
				const form = document.getElementById(targetId);
				form.classList.toggle('d-none');
			});
		});

		document.querySelectorAll('.toggle-beli').forEach(function(btn) {
			btn.addEventListener('click', function() {
				const targetId = btn.getAttribute('data-target');
				const form = document.getElementById(targetId);
				form.classList.toggle('d-none');
			});
		});
	</script>


</body>

</html>