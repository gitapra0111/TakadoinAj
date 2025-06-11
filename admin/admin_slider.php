<?php
// filepath: admin/slider.php
session_start();
include '../koneksi.php';

// Cek login admin (tambahkan pengecekan sesuai sistem Anda)
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
}

// Proses tambah/edit/hapus slider
if (isset($_POST['simpan'])) {
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $tombol_teks = $_POST['tombol_teks'];
  $tombol_link = $_POST['tombol_link'];
  $urutan = intval($_POST['urutan']);
  $aktif = isset($_POST['aktif']) ? 1 : 0;

  // Upload gambar jika ada
  $gambar = '';
  if (!empty($_FILES['gambar']['name'])) {
    $target = '../img/slider_' . time() . '_' . basename($_FILES['gambar']['name']);
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
      $gambar = $target;
    }
  }

  if ($_POST['id']) {
    // Edit
    $id = intval($_POST['id']);
    if ($gambar) {
      mysqli_query($conn, "UPDATE slider SET judul='$judul', deskripsi='$deskripsi', tombol_teks='$tombol_teks', tombol_link='$tombol_link', urutan=$urutan, aktif=$aktif, gambar='$gambar' WHERE id=$id");
    } else {
      mysqli_query($conn, "UPDATE slider SET judul='$judul', deskripsi='$deskripsi', tombol_teks='$tombol_teks', tombol_link='$tombol_link', urutan=$urutan, aktif=$aktif WHERE id=$id");
    }
  } else {
    // Tambah
    mysqli_query($conn, "INSERT INTO slider (judul, deskripsi, tombol_teks, tombol_link, urutan, aktif, gambar) VALUES ('$judul','$deskripsi','$tombol_teks','$tombol_link',$urutan,$aktif,'$gambar')");
  }
  header('Location: admin_slider.php');
  exit;
}

if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($conn, "DELETE FROM slider WHERE id=$id");
  header('Location: admin_slider.php');
  exit;
}

// Ambil data slider
$sliders = mysqli_query($conn, "SELECT * FROM slider ORDER BY urutan ASC, id ASC");
$edit = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM slider WHERE id=$id"));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Slider - Admin Takadoin.aj</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #f8fafc; min-height: 100vh; }
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
    .card-header {
      background: #ffc107;
      font-weight: bold;
      letter-spacing: 1px;
      border-bottom: 1px solid #ffe082;
    }
    .btn-primary, .btn-success {
      box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .btn-danger {
      box-shadow: 0 2px 8px rgba(255,0,0,0.07);
    }
    .form-label {
      font-weight: 500;
    }
    .table img {
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    @media (max-width: 991.98px) {
      .sidebar { margin-bottom: 1rem; }
    }
  </style>
</head>
<body>
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
          <a class="nav-link" href="tambahadmin.php"><i class="bi bi-person-gear"></i> Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="admin_slider.php"><i class="bi bi-images"></i> Slider Konten</a>
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
        <h2 class="fw-bold mb-1"><i class="bi bi-images"></i> Kelola Slider Header</h2>
        <p class="mb-0">Tambah, edit, dan hapus slider halaman utama Takadoin.aj</p>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-4">
            <div class="table-responsive rounded shadow">
              <table class="table table-bordered align-middle">
                <thead>
                  <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Urutan</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($row = mysqli_fetch_assoc($sliders)): ?>
                  <tr>
                    <td><img src="<?= htmlspecialchars($row['gambar']) ?>" width="80"></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td><?= $row['urutan'] ?></td>
                    <td>
                      <?php if($row['aktif']): ?>
                        <span class="badge bg-success">Ya</span>
                      <?php else: ?>
                        <span class="badge bg-secondary">Tidak</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="admin_slider.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                      <a href="admin_slider.php?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus slider ini?')"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-5">
            <div class="card shadow-sm">
              <div class="card-header"><?= $edit ? 'Edit Slider' : 'Tambah Slider' ?></div>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?= $edit ? $edit['id'] : '' ?>">
                  <div class="mb-2">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required value="<?= $edit ? htmlspecialchars($edit['judul']) : '' ?>">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required><?= $edit ? htmlspecialchars($edit['deskripsi']) : '' ?></textarea>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Teks Tombol</label>
                    <input type="text" name="tombol_teks" class="form-control" value="<?= $edit ? htmlspecialchars($edit['tombol_teks']) : '' ?>">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Link Tombol</label>
                    <input type="text" name="tombol_link" class="form-control" value="<?= $edit ? htmlspecialchars($edit['tombol_link']) : '' ?>">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="<?= $edit ? $edit['urutan'] : '0' ?>">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Aktif</label>
                    <input type="checkbox" name="aktif" value="1" <?= $edit && $edit['aktif'] ? 'checked' : (!$edit ? 'checked' : '') ?>>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Gambar <?= $edit ? '(Kosongkan jika tidak diganti)' : '' ?></label>
                    <input type="file" name="gambar" class="form-control" <?= $edit ? '' : 'required' ?>>
                  </div>
                  <button type="submit" name="simpan" class="btn btn-success w-100"><?= $edit ? 'Update' : 'Tambah' ?></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>