<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login - Kantin Kejujuran</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 1rem;
      padding: 2rem;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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
    }

    .btn-primary {
      background-color: #ffffff;
      color: #0072ff;
      border: none;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #e6e6e6;
      color: #0072ff;
    }

    a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="glass-card text-center">
    <h3 class="mb-4"><i class="bi bi-shield-lock-fill"></i> Login</h3>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/do_login') ?>">

      <div class="form-floating mb-3">
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        <label for="username"><i class="bi bi-person-fill"></i> Username</label>
      </div>

      <div class="form-floating mb-4">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password"><i class="bi bi-lock-fill"></i> Password</label>
      </div>

      <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>

    <p class="mt-3">Belum punya akun? <a href="<?= site_url('auth/register') ?>">Daftar sekarang</a></p>
  </div>

</body>

</html>