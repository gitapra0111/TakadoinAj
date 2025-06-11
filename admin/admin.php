<?php
session_start();
include('../koneksi.php');
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Proses Hapus Produk
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    header("Location: admin.php");
    exit;
}

// Proses Edit Produk
if (isset($_POST['simpan_edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $harga_diskon = $_POST['harga_diskon'];
    $rating = $_POST['rating'];

    // Gambar opsional
    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../img/$gambar");
        $update = "UPDATE produk SET nama='$nama', harga='$harga', status='$status', harga_diskon='$harga_diskon', rating='$rating', gambar='$gambar' WHERE id=$id";
    } else {
        $update = "UPDATE produk SET nama='$nama', harga='$harga', status='$status', harga_diskon='$harga_diskon', rating='$rating' WHERE id=$id";
    }

    mysqli_query($conn, $update);
    header("Location: admin.php");
    exit;
}

// Ambil produk
$produk = mysqli_query($conn, "SELECT * FROM produk");

// Untuk form edit
$edit_id = isset($_GET['edit']) ? $_GET['edit'] : null;
$produk_edit = null;
if ($edit_id) {
    $produk_edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$edit_id"));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Takadoin.aj</title>
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
        .table img {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-speedometer2"></i> Admin Takadoin.aj</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php"><i class="bi bi-basket"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminpesanan.php"><i class="bi bi-receipt"></i> Pesanan</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link " href="tambahadmin.php"><i class="bi bi-person-gear"></i> Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_slider.php"><i class="bi bi-images"></i> Slider Konten</a>
                    </li>
                </ul>
                <span class="navbar-text me-3 text-warning">
                    <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>
                <a href="login.php" class="btn btn-warning btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar (optional, for consistency with other admin pages) -->
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
              <h2 class="fw-bold mb-1">Dashboard Admin</h2>
              <p class="mb-0">Kelola produk, pesanan, pengguna, dan slider Takadoin.aj dengan mudah</p>
          </div>
          <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="mb-0">Daftar Produk</h4>
                  <a href="add_product.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
              </div>
              <div class="table-responsive rounded shadow">
                  <table class="table table-bordered align-middle">
                      <thead>
                          <tr>
                              <th>Gambar</th>
                              <th>Nama</th>
                              <th>Harga</th>
                              <th>Status</th>
                              <th>Harga Diskon</th>
                              <th>Rating</th>
                              <th style="width:140px;">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
                          <tr>
                              <td><img src="../img/<?= htmlspecialchars($p['gambar']) ?>" width="80" class="rounded"></td>
                              <td><?= htmlspecialchars($p['nama']) ?></td>
                              <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                              <td>
                                  <?php if($p['status'] == 'normal'): ?>
                                      <span class="badge bg-primary">Normal</span>
                                  <?php else: ?>
                                      <span class="badge bg-success">Sale</span>
                                  <?php endif; ?>
                              </td>
                              <td><?= $p['harga_diskon'] ? 'Rp '.number_format($p['harga_diskon'],0,',','.') : '-' ?></td>
                              <td><?= $p['rating'] ?></td>
                              <td>
                                  <a href="admin.php?edit=<?= $p['id'] ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-pencil"></i> Edit</a>
                                  <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                      <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                      <button type="submit" name="hapus" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                  </form>
                              </td>
                          </tr>
                      <?php } ?>
                      </tbody>
                  </table>
              </div>
              
              <?php if ($produk_edit): ?>
              <div class="edit-form mx-auto">
                  <h4 class="mb-3">Edit Produk</h4>
                  <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $produk_edit['id'] ?>">
                      <div class="mb-2">
                          <label class="form-label">Nama Produk</label>
                          <input name="nama" value="<?= htmlspecialchars($produk_edit['nama']) ?>" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Harga</label>
                          <input name="harga" value="<?= htmlspecialchars($produk_edit['harga']) ?>" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Status</label>
                          <select name="status" class="form-select">
                              <option value="normal" <?= $produk_edit['status'] == 'normal' ? 'selected' : '' ?>>Normal</option>
                              <option value="sale" <?= $produk_edit['status'] == 'sale' ? 'selected' : '' ?>>Sale</option>
                          </select>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Harga Diskon</label>
                          <input name="harga_diskon" value="<?= htmlspecialchars($produk_edit['harga_diskon']) ?>" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Rating</label>
                          <input name="rating" value="<?= htmlspecialchars($produk_edit['rating']) ?>" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Ganti Gambar (opsional)</label>
                          <input type="file" name="gambar" class="form-control">
                      </div>
                      <div class="mt-3 d-flex gap-2">
                          <button type="submit" name="simpan_edit" class="btn btn-warning">Simpan Perubahan</button>
                          <a href="admin.php" class="btn btn-secondary">Batal</a>
                      </div>
                  </form>
              </div>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
