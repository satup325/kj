<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Struk Transaksi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

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
			padding: 2rem 1rem;
		}

		.struk-container {
			max-width: 500px;
			width: 100%;
			margin: auto;
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(15px);
			border-radius: 1rem;
			padding: 2rem 1.5rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
		}

		h4,
		h5,
		h6 {
			text-align: center;
			margin-bottom: .1rem;
		}

		h6 {
			font-size: .9rem;
		}

		.line {
			border-top: 1px dashed #fff;
			margin: 1rem 0;
		}

		table {
			width: 100%;
			font-size: 0.95rem;
		}

		table td {
			padding: 4px 0;
		}

		.text-right {
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		.btn-print,
		.btn-back {
			display: block;
			width: 100%;
			margin-top: 1rem;
			font-weight: bold;
		}

		.btn-print,
		.btn-back {
			background-color: #fff;
			color: #0072ff;
		}

		.btn-print:hover,
		.btn-back:hover {
			background-color:rgb(219, 219, 219);
			color: #0072ff;
		}

		@media (max-width: 576px) {
			.struk-container {
				padding: 1.5rem 1rem;
			}

			table td {
				font-size: 0.85rem;
			}

			h4,
			h5 {
				font-size: 1rem;
			}

			h6 {
				font-size: .8rem;
			}
		}
	</style>
</head>

<body>

	<div class="struk-container">
		<h4>KANTIN KEJUJURAN</h4>
		<h4>BPS Kota Gunungsitoli</h4>
		<h6>Jl. Arah Puskesmas No. 9, Desa Hilinaa, Gunungsitoli</h6>
		<div class="line"></div>

		<table>
			<tr>
				<td>Tanggal</td>
				<td class="text-right"><?= date('d-m-Y | H:i', strtotime($transaksi->tanggal ?? 'now')) ?></td>
			</tr>
			<tr>
				<td>ID Transaksi</td>
				<td class="text-right"><?= $transaksi->id_transaksi ?? '-' ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td class="text-right"><?= $user->username ?? '-' ?></td>
			</tr>
		</table>

		<div class="line"></div>

		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th>Nama Produk</th>
						<th class="text-center">Qty x Harga</th>
						<th class="text-right">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detail as $item): ?>
						<tr>
							<td><?= $item->nama_produk ?></td>
							<td class="text-center"><?= $item->jumlah ?> x <?= number_format($item->harga, 0, ',', '.') ?></td>
							<td class="text-right">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="line"></div>

		<table>
			<tr>
				<td><strong>Total</strong></td>
				<td class="text-right"><strong>Rp <?= number_format($transaksi->total ?? 0, 0, ',', '.') ?></strong></td>
			</tr>
		</table>

		<div class="line"></div>
		<p class="text-center">Terima kasih telah membeli</p>

		<a href="<?= site_url('user/selesai/struk_pdf/' . $transaksi->id_transaksi) ?>" class="btn btn-print mt-2" target="_blank">
			<i class="bi bi-file-earmark-pdf"></i> Download PDF
		</a>
		<a href="<?= site_url('user/selesai')?>" class="btn btn-back btn-light">
			<i class="bi bi-arrow-left-circle"></i> Kembali
		</a>
	</div>

</body>

</html>
