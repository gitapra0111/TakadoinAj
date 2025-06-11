<?php
session_start();
include('../koneksi.php');

// Tambah admin baru
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "INSERT INTO admin (username, password, nama, email) VALUES ('$username', '$password', '$nama', '$email')");
    header("Location: tambahadmin.php");
    exit;
}

// Hapus admin
if (isset($_POST['hapus'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn, "DELETE FROM admin WHERE id=$id");
    header("Location: tambahadmin.php");
    exit;
}

// Edit admin
$edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : null;
$admin_edit = null;
if ($edit_id) {
    $admin_edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE id=$edit_id"));
}
if (isset($_POST['simpan_edit'])) {
    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $update = "UPDATE admin SET username='$username', nama='$nama', email='$email'";
    if (!empty($_POST['password'])) {
        $password = hash('sha256', $_POST['password']);
        $update .= ", password='$password'";
    }
    $update .= " WHERE id=$id";
    mysqli_query($conn, $update);
    header("Location: tambahadmin.php");
    exit;
}

$admins = mysqli_query($conn, "SELECT * FROM admin ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin - Takadoin.aj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
        }
        .admin-navbar {
            background: #212529;
            color: #fff;
            margin-bottom: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .admin-navbar .navbar-brand, .admin-navbar .nav-link {
            color: #fff !important;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .admin-navbar .nav-link.active, .admin-navbar .nav-link:focus {
            color: #ffc107 !important;
        }
        .sidebar {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 1.5rem 1rem;
            margin-bottom: 2rem;
        }
        .sidebar .nav-link {
            color: #212529;
            border-radius: 6px;
            margin-bottom: 4px;
            transition: background .15s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #ffc107;
            color: #212529 !important;
        }
        .admin-header {
            background: #212529;
            color: #ffc107;
            padding: 24px 0 16px 0;
            margin-bottom: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .table thead th {
            background: #f1f3f5;
            color: #212529;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody tr {
            background: #fff;
        }
        .edit-form {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 24px;
            margin-top: 32px;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="admin.php"><i class="bi bi-speedometer2"></i> Admin Takadoin.aj</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php"><i class="bi bi-basket"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminpesanan.php"><i class="bi bi-receipt"></i> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tambahadmin.php"><i class="bi bi-person-gear"></i> Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_slider.php"><i class="bi bi-images"></i> Slider Konten</a>
                    </li>
                </ul>
                <a href="login.php" class="btn btn-warning btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2 d-none d-lg-block">
          <div class="sidebar">
            <nav class="nav flex-column">
              <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'admin.php' ? ' active' : '' ?>" href="admin.php"><i class="bi bi-basket"></i> Produk</a>
              <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'adminpesanan.php' ? ' active' : '' ?>" href="adminpesanan.php"><i class="bi bi-receipt"></i> Pesanan</a>
              <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'tambahadmin.php' ? ' active' : '' ?>" href="tambahadmin.php"><i class="bi bi-person-gear"></i> Admin</a>
              <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'admin_slider.php' ? ' active' : '' ?>" href="admin_slider.php"><i class="bi bi-images"></i> Slider Konten</a>
              <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </nav>
          </div>
        </div>
        <div class="col-lg-10">
          <div class="admin-header text-center">
              <h2 class="fw-bold mb-1"><i class="bi bi-person-gear"></i> Kelola Admin</h2>
              <p class="mb-0">Tambah, edit, dan hapus admin Takadoin.aj</p>
          </div>
          <div class="container">
            <div class="table-responsive rounded shadow mb-4">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($admins)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <a href="tambahadmin.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-pencil"></i> Edit</a>
                                <?php if ($row['id'] != $_SESSION['admin']): // tidak bisa hapus diri sendiri ?>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="hapus" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- Form tambah/edit admin -->
            <div class="edit-form mx-auto">
                <h5 class="mb-3 text-center text-warning">
                    <i class="bi bi-person-plus"></i>
                    <?= $admin_edit ? 'Edit Admin' : 'Tambah Admin Baru' ?>
                </h5>
                <form method="POST">
                    <?php if ($admin_edit): ?>
                        <input type="hidden" name="id" value="<?= $admin_edit['id'] ?>">
                    <?php endif; ?>
                    <div class="mb-2">
                        <label class="form-label">Username</label>
                        <input name="username" value="<?= $admin_edit ? htmlspecialchars($admin_edit['username']) : '' ?>" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input name="nama" value="<?= $admin_edit ? htmlspecialchars($admin_edit['nama']) : '' ?>" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" value="<?= $admin_edit ? htmlspecialchars($admin_edit['email']) : '' ?>" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label"><?= $admin_edit ? 'Password Baru (opsional)' : 'Password' ?></label>
                        <input name="password" type="password" class="form-control" <?= $admin_edit ? '' : 'required' ?>>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" name="<?= $admin_edit ? 'simpan_edit' : 'tambah' ?>" class="btn btn-warning w-100">
                            <?= $admin_edit ? 'Simpan Perubahan' : 'Tambah Admin' ?>
                        </button>
                        <?php if ($admin_edit): ?>
                            <a href="tambahadmin.php" class="btn btn-secondary w-100">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>