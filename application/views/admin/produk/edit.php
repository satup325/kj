<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #fff;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 1rem;
            padding: 2rem;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #e0e0e0;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: #fff;
        }

        .btn-primary {
            background-color: #ffffff;
            color: #0072ff;
            font-weight: 600;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e6e6e6;
            color: #0072ff;
        }

        label {
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="glass-card">
        <h4 class="mb-4 text-center"><i class="bi bi-pencil-square"></i> Edit Produk</h4>

        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/produk/edit/' . $produk->id_produk) ?>">
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Jumlah Satuan Besar</label>
                    <input type="number" name="jumlah_satuan_besar" id="jumlah_satuan_besar" class="form-control" value="<?= $produk->jumlah_satuan_besar ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Isi per Satuan Besar</label>
                    <input type="number" name="isi" id="isi" class="form-control" value="<?= $produk->isi ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Harga Satuan Besar (Rp)</label>
                <input type="number" name="harga_satuan_besar" id="harga_satuan_besar" class="form-control" value="<?= $produk->harga_satuan_besar ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Stok Awal (Otomatis)</label>
                    <input type="number" id="stok_awal" class="form-control" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stok Saat Ini (Otomatis)</label>
                    <input type="number" id="stok" class="form-control" value="<?= $produk->stok ?>" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Harga Eceran (Otomatis)</label>
                    <input type="number" id="harga_eceran" class="form-control" value="<?= $produk->harga_eceran ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="<?= $produk->harga_jual ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <?php if (!empty($produk->gambar)): ?>
                    <img src="<?= base_url('assets/images/produk/' . $produk->gambar) ?>" alt="Gambar Produk" class="img-thumbnail mt-2" style="max-height: 150px;">
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        const jumlah = document.getElementById('jumlah_satuan_besar');
        const isi = document.getElementById('isi');
        const hargaBesar = document.getElementById('harga_satuan_besar');
        const hargaEcer = document.getElementById('harga_eceran');
        const stok = document.getElementById('stok');
        const stokAwal = document.getElementById('stok_awal');

        function updateHargaStok() {
            const jml = parseInt(jumlah.value) || 0;
            const isiVal = parseInt(isi.value) || 1;
            const harga = parseInt(hargaBesar.value) || 0;

            const totalStokAwal = jml * isiVal;

            hargaEcer.value = isiVal > 0 ? Math.floor(harga / isiVal) : 0;
            stokAwal.value = totalStokAwal;
            // Tidak menyentuh stok.value agar tetap sesuai database
        }

        jumlah.addEventListener('input', updateHargaStok);
        isi.addEventListener('input', updateHargaStok);
        hargaBesar.addEventListener('input', updateHargaStok);

        // Inisialisasi hanya harga eceran & stok awal
        updateHargaStok();
    </script>

</body>

</html>