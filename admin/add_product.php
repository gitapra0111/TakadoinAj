<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $harga_diskon = $_POST['harga_diskon'];
    $rating = $_POST['rating'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    if ($gambar) {
        move_uploaded_file($tmp, "../img/$gambar");
    }

    $sql = "INSERT INTO produk (nama, harga, gambar, status, harga_diskon, rating)
            VALUES ('$nama', '$harga', '$gambar', '$status', '$harga_diskon', '$rating')";
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Admin Takadoin.aj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            min-height: 100vh;
        }
        .admin-navbar .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
        }
        .admin-navbar .nav-link {
            color: #fff !important;
        }
        .add-form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 32px 28px;
            max-width: 500px;
            margin: 48px auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="admin.php">Admin Takadoin.aj</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php"><i class="bi bi-box-seam"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminpesanan.php"><i class="bi bi-receipt"></i> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahadmin.php"><i class="bi bi-people"></i> Pengguna</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-warning btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="add-form-container">
        <h3 class="mb-4 text-center fw-bold text-warning"><i class="bi bi-plus-circle"></i> Tambah Produk Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input name="harga" type="number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="normal">Normal</option>
                    <option value="sale">Sale</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Diskon (opsional)</label>
                <input name="harga_diskon" type="number" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Rating (1-5)</label>
                <input name="rating" type="number" min="1" max="5" class="form-control">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning w-100"><i class="bi bi-save"></i> Simpan Produk</button>
                <a href="admin.php" class="btn btn-secondary w-100">Kembali</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
