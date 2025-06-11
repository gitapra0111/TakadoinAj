<?php
session_start();
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = hash('sha256', $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Takadoin.aj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            min-height: 100vh;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            padding: 32px 28px;
        }
        .login-title {
            font-weight: bold;
            letter-spacing: 1px;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="../img/logo.jpg" alt="Logo" width="64" class="mb-2">
            <h3 class="login-title">Admin Takadoin.aj</h3>
            <p class="text-muted mb-0">Silakan login untuk mengakses dashboard</p>
        </div>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger py-2"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>
    </div>
</body>
</html>
