<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Transaksi - <?= $periode ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2,
        h4 {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center;">Laporan Transaksi</h2>
    <h4 style="text-align:center;">Periode: <?= $periode ?></h4>
    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laporan)) : ?>
                <?php $no = 1;
                foreach ($laporan as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row->tanggal)) ?></td>
                        <td><?= $row->nama_produk ?></td>
                        <td><?= $row->jumlah ?></td>
                        <td>Rp <?= number_format($row->subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>