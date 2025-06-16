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
		body {
			font-family: 'Poppins', sans-serif;
			color: #000;
			background: #fff;
			margin: 0;
			padding: 1rem;
		}

		.struk-container {
			max-width: 300px;
			width: 100%;
			margin: auto;
			padding: 1rem;
			border: 1px solid #ccc;
			border-radius: 8px;
		}

		.line {
			border-top: 1px dashed #333;
			margin: 1rem 0;
		}

		table {
			width: 100%;
			font-size: 12px;
		}

		th:first-child {
			text-align: left;
		}

		.text-right {
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		h4,
		h5,
		h6 {
			text-align: center;
			margin-top: 0;
			margin-bottom: 0;
			line-height: 1.2;
		}


		h6 {
			font-size: .5rem;
		}

		p {
			font-size: 12px;
		}
	</style>
</head>

<body>

	<div class="struk-container">
		<h4>KANTIN KEJUJURAN</h4>
		<h4>BPS Kota Gunungsitoli</h4>
		<div style="margin-bottom: .25rem;"></div>
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
	</div>

</body>

</html>
