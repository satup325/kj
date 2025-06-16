<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Dashboard User</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

	<style>
		html,
		body {
			height: auto;
			min-height: 100%;
			margin: 0;
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #00c6ff, #0072ff);
			background-attachment: fixed;
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
			padding: 2rem;
		}

		.table-container {
			border-radius: 1rem;
			padding: 1rem;
			overflow-x: auto;
			box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
		}

		.glass-table {
			width: 100%;
			border-collapse: collapse;
			backdrop-filter: blur(12px);
			background: rgba(255, 255, 255, 0.05);
			border-radius: 1rem;
			overflow: hidden;
		}

		.glass-table thead {
			background: rgba(255, 255, 255, 0.15);
			color: #fff;
			text-transform: uppercase;
			font-size: 0.85rem;
		}

		.glass-table th,
		.glass-table td {
			padding: 0.9rem 1rem;
			color: #fff;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.glass-table tbody tr:hover {
			background: rgba(255, 255, 255, 0.1);
		}

		.transaksi-group:hover tr {
			background: rgba(255, 255, 255, 0.1);
		}

		.transaksi-group tr {
			transition: background 0.3s ease;
		}

		.btn-struk {
			display: inline-block;
			padding: 0.4rem 1rem;
			font-size: 0.85rem;
			color: #fff;
			background: rgba(255, 255, 255, 0.15);
			border: 1px solid rgba(255, 255, 255, 0.3);
			border-radius: 0.75rem;
			backdrop-filter: blur(10px);
			transition: all 0.25s ease;
			text-decoration: none;
			font-weight: 500;
		}

		.btn-struk:hover {
			background: #ffffff;
			color: #0072ff;
			transform: scale(1.05);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
		}

		/* Highlight satu grup transaksi */
		.transaksi-row:hover~.transaksi-row {
			background: rgba(255, 255, 255, 0.1);
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
		<a href="<?= site_url('user/keranjang') ?>"><i class="bi bi-cart4 me-2"></i>Keranjang</a>
		<a href="<?= site_url('user/selesai') ?>" class="active"><i class="bi bi-check-circle me-2"></i>Selesai</a>
		<a href="<?= site_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
	</div>

	<!-- Main Content -->
	<div class="main-content">
		<div>
			<h3 class="mb-4">Transaksi Selesai</h3>
			<?php if (empty($transaksi)) : ?>
				<p class="text-center">Tidak ada transaksi.</p>
			<?php else : ?>
				<div class="table-container">
					<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
					</div>
					<form method="get" class="d-flex align-items-center mb-3">
						<label class="me-2">Tampilkan</label>
						<select name="limit" onchange="this.form.submit()" class="form-select w-auto">
							<?php foreach ([5, 10, 25, 50] as $val): ?>
								<option value="<?= $val ?>" <?= $limit == $val ? 'selected' : '' ?>><?= $val ?></option>
							<?php endforeach; ?>
						</select>
						<label class="ms-2">entri</label>
					</form>
					<table id="transaksiTable" class="glass-table">
						<thead>
							<tr class="text-center">
								<th>Tanggal</th>
								<th>Produk</th>
								<th>Jumlah</th>
								<th>Subtotal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody class="transaksi-group">
							<?php foreach ($transaksi as $t) : ?>
								<?php $rowspan = count($t['items']); ?>
								<?php foreach ($t['items'] as $i => $item) : ?>
									<tr class="transaksi-row">
										<?php if ($i == 0) : ?>
											<td rowspan="<?= $rowspan ?>" class="tanggal-col"><?= date('d-m-Y H:i', strtotime($t['tanggal'])) ?></td>
										<?php endif; ?>
										<td class="produk-col"><?= $item['nama_produk'] ?></td>
										<td class="text-center"><?= $item['jumlah'] ?></td>
										<td class="subtotal-col">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
										<?php if ($i == 0) : ?>
											<td rowspan="<?= $rowspan ?>" class="text-center align-middle aksi-col">
												<a href="<?= site_url('user/selesai/struk/' . $t['id_transaksi']) ?>" class="btn-struk">
													<i class="bi bi-receipt"></i> Struk
												</a>
											</td>
										<?php endif; ?>
									</tr>
								<?php endforeach; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php
					$total_pages = ceil($total / $limit);
					$prev_page = max(1, $page - 1);
					$next_page = min($total_pages, $page + 1);
					?>
					<div class="d-flex justify-content-end mt-3 gap-2 flex-wrap align-items-center">
						<?php if ($page > 1): ?>
							<a href="<?= site_url("user/selesai?limit=$limit&page=$prev_page") ?>" class="btn btn-sm btn-outline-light">
								<i class="bi bi-chevron-left"></i> Previous
							</a>
						<?php endif; ?>

						<?php for ($i = 1; $i <= $total_pages; $i++): ?>
							<a href="<?= site_url("user/selesai?limit=$limit&page=$i") ?>"
								class="btn btn-sm <?= $i == $page ? 'btn-primary' : 'btn-outline-light' ?>">
								<?= $i ?>
							</a>
						<?php endfor; ?>

						<?php if ($page < $total_pages): ?>
							<a href="<?= site_url("user/selesai?limit=$limit&page=$next_page") ?>" class="btn btn-sm btn-outline-light">
								Next <i class="bi bi-chevron-right"></i>
							</a>
						<?php endif; ?>
					</div>

				</div>

			<?php endif; ?>
		</div>
	</div>
</body>

</html>