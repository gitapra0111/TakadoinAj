<?php
session_start();
include('../koneksi.php');

// Hapus pesanan
if (isset($_POST['hapus'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn, "DELETE FROM pesanan WHERE id=$id");
    header("Location: adminpesanan.php");
    exit;
}

// Edit pesanan (hanya data diri, bukan produk)
$edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : null;
$pesanan_edit = null;
if ($edit_id) {
    $pesanan_edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pesanan WHERE id=$edit_id"));
}

// Update pesanan (data diri dan gambar produk)
if (isset($_POST['simpan_edit'])) {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat_rumah']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no = mysqli_real_escape_string($conn, $_POST['no']);

    // Ambil data produk lama
    $produk_lama = [];
    if (!empty($_POST['produk_lama'])) {
        $produk_lama = json_decode($_POST['produk_lama'], true);
    }

    // Proses upload gambar baru jika ada
    if (isset($_FILES['gambar_produk']) && !empty($_FILES['gambar_produk']['name'][0])) {
        foreach ($_FILES['gambar_produk']['name'] as $i => $nama_file) {
            if ($nama_file) {
                $tmp = $_FILES['gambar_produk']['tmp_name'][$i];
                $target = "../img/" . basename($nama_file);
                move_uploaded_file($tmp, $target);
                // Update gambar pada produk ke-i
                if (isset($produk_lama[$i])) {
                    $produk_lama[$i]['gambar'] = "img/" . $nama_file;
                }
            }
        }
    }

    // Update nama produk/harga jika diedit (opsional, bisa dikembangkan)
    if (isset($_POST['nama_produk']) && isset($_POST['harga_produk'])) {
        foreach ($produk_lama as $i => $p) {
            $produk_lama[$i]['nama'] = $_POST['nama_produk'][$i];
            $produk_lama[$i]['harga'] = $_POST['harga_produk'][$i];
        }
    }

    $produk_json = mysqli_real_escape_string($conn, json_encode($produk_lama));

    mysqli_query($conn, "UPDATE pesanan SET nama='$nama', alamat_rumah='$alamat', email='$email', no='$no', produk='$produk_json' WHERE id=$id");
    header("Location: adminpesanan.php");
    exit;
}

$pesanan = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Masuk - Admin Takadoin.aj</title>
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
            max-width: 600px;
        }
        .produk-img-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 6px;
            border: 1px solid #eee;
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
                        <a class="nav-link active" href="adminpesanan.php"><i class="bi bi-receipt"></i> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahadmin.php"><i class="bi bi-person-gear"></i> Admin</a>
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
              <h2 class="fw-bold mb-1"><i class="bi bi-receipt"></i> Daftar Pesanan Masuk</h2>
              <p class="mb-0">Kelola pesanan pelanggan Takadoin.aj dengan mudah</p>
          </div>
          <div class="container">
            <div class="table-responsive rounded shadow mb-4">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($pesanan)): ?>
                        <tr>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat_rumah']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['no']) ?></td>
                            <td>
                                <?php
                                $produk = json_decode($row['produk'], true);
                                if ($produk) {
                                    // Hitung jumlah produk dengan nama yang sama
                                    $produk_count = [];
                                    foreach ($produk as $p) {
                                        $nama = $p['nama'];
                                        $harga = $p['harga'];
                                        $gambar = !empty($p['gambar']) ? $p['gambar'] : '';
                                        $key = $nama . '|' . $harga . '|' . $gambar;
                                        if (!isset($produk_count[$key])) {
                                            $produk_count[$key] = [
                                                'nama' => $nama,
                                                'harga' => $harga,
                                                'gambar' => $gambar,
                                                'qty' => 1
                                            ];
                                        } else {
                                            $produk_count[$key]['qty']++;
                                        }
                                    }
                                    foreach ($produk_count as $item) {
                                        if (!empty($item['gambar'])) {
                                            echo '<img src="../'.htmlspecialchars($item['gambar']).'" class="produk-img-thumb" alt="'.htmlspecialchars($item['nama']).'">';
                                        }
                                        echo htmlspecialchars($item['nama']) . ' (' . $item['harga'] . ')';
                                        if ($item['qty'] > 1) {
                                            echo ' <span class="badge bg-info text-dark">x' . $item['qty'] . '</span>';
                                        }
                                        echo '<br>';
                                    }
                                }
                                ?>
                            </td>
                            <td>Rp <?= number_format($row['total'],0,',','.') ?></td>
                            <td>
                                <a href="adminpesanan.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-pencil"></i> Edit</a>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="hapus" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($pesanan_edit): ?>
            <div class="edit-form mx-auto">
                <h5 class="mb-3 text-center text-warning"><i class="bi bi-pencil"></i> Edit Data Pesanan & Produk</h5>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $pesanan_edit['id'] ?>">
                    <input type="hidden" name="produk_lama" value='<?= htmlspecialchars($pesanan_edit['produk'], ENT_QUOTES) ?>'>
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input name="nama" value="<?= htmlspecialchars($pesanan_edit['nama']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat_rumah" class="form-control" required><?= htmlspecialchars($pesanan_edit['alamat_rumah']) ?></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" value="<?= htmlspecialchars($pesanan_edit['email']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">No Telp</label>
                        <input name="no" value="<?= htmlspecialchars($pesanan_edit['no']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Produk yang Dipesan</label>
                        <?php
                        $produk = json_decode($pesanan_edit['produk'], true);
                        if ($produk) {
                            foreach($produk as $i => $p) {
                                ?>
                                <div class="mb-2 d-flex align-items-center">
                                    <?php if (!empty($p['gambar'])): ?>
                                        <img src="../<?= htmlspecialchars($p['gambar']) ?>" class="produk-img-thumb me-2" alt="<?= htmlspecialchars($p['nama']) ?>">
                                    <?php endif; ?>
                                    <input type="text" name="nama_produk[]" value="<?= htmlspecialchars($p['nama']) ?>" class="form-control me-2" style="max-width:150px;" required>
                                    <input type="text" name="harga_produk[]" value="<?= htmlspecialchars($p['harga']) ?>" class="form-control me-2" style="max-width:100px;" required>
                                    <input type="file" name="gambar_produk[]" class="form-control" style="max-width:180px;">
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" name="simpan_edit" class="btn btn-warning">Simpan Perubahan</button>
                        <a href="adminpesanan.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
            <?php endif; ?>

            <!-- Form tambah data pesanan manual (opsional) -->
            <div class="edit-form mx-auto mt-5">
                <h5 class="mb-3 text-center text-warning"><i class="bi bi-plus-circle"></i> Tambah Pesanan Manual</h5>
                <form method="POST" action="tambahpesanan.php" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input name="nama" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat_rumah" class="form-control" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">No Telp</label>
                        <input name="no" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Produk (format: Nama(Harga), pisahkan dengan koma)</label>
                        <input name="produk" class="form-control" placeholder="Contoh: Mawar(50000), Melati(30000)" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Total Bayar</label>
                        <input name="total" type="number" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success w-100"><i class="bi bi-check-circle"></i> Tambah Pesanan</button>
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