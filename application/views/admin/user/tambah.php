<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
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

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('admin/user/store') ?>">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username"
                    value="<?= isset($old_input['username']) ? htmlspecialchars($old_input['username']) : '' ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Masukkan email"
                    value="<?= isset($old_input['email']) ? htmlspecialchars($old_input['email']) : '' ?>">
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
                    <option value="admin" style="color:black;" <?= isset($old_input['role']) && $old_input['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" style="color:black;" <?= isset($old_input['role']) && $old_input['role'] === 'user' ? 'selected' : '' ?>>User</option>
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