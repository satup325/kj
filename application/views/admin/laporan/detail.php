<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            min-height: 100vh;
            color: #fff;
            padding: 2rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 1rem;
            padding: 2rem;
            color: #fff;
        }

        .table th,
        .table td {
            color: black;
        }
    </style>
</head>

<body>
    <div class="glass-card">
        <h3>Detail Transaksi</h3>
        <?php if (!empty($laporan)) : ?>
            <p><strong>ID Transaksi:</strong> <?= $laporan[0]->id_transaksi ?></p>
            <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($laporan[0]->tanggal)) ?></p>
            <p><strong>Total:</strong> Rp <?= number_format($laporan[0]->total, 0, ',', '.') ?></p>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $item) : ?>
                        <tr>
                            <td><?= $item->nama_produk ?></td>
                            <td><?= $item->jumlah ?></td>
                            <td>Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>
        <a href="<?= site_url('admin/laporan') ?>" class="btn btn-light mt-3">Kembali</a>
    </div>
</body>

</html>