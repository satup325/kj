<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
            max-width: 500px;
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
        <h4 class="mb-4 text-center"><i class="bi bi-person-plus-fill"></i> Tambah User</h4>

        <form method="post" action="<?= site_url('admin/user/store') ?>">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Masukkan email">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="form-control" required placeholder="Ulangi password">
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="" style="color:black;">-- Pilih Role --</option>
                    <option value="admin" style="color:black;">Admin</option>
                    <option value="user" style="color:black;">User</option>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?= site_url('admin/user') ?>" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

</body>

</html>