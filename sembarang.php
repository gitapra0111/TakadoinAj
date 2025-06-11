<?php
include('koneksi.php');
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE status='normal' OR status='sale' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Takadoin.Aj</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/kranjang.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Header dengan Carousel/Slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
    .carousel-caption {
      background: rgba(0,0,0,0.45);
      border-radius: 12px;
      padding: 1.5rem;
    }
    .carousel-item img {
      object-fit: cover;
      height: 350px;
      width: 100%;
    }
    @media (min-width: 992px) {
      .carousel-item img {
        height: 420px;
      }
    }
    </style>
  </head>
  <body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">
          <img
            src="assets/favicon.ico"
            alt="Logo"
            style="height: 32px; vertical-align: middle; margin-right: 8px"
          />
          Takadoin.Aj
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#!">Home</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                id="navbarDropdown"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Shop</a
              >
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">All Products</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex">
            <button
              class="btn btn-outline-dark"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#shoppingCart"
              aria-controls="shoppingCart"
            >
              <i class="bi-cart-fill me-1"></i>
              Cart
              <span
                class="badge bg-dark text-white ms-1 rounded-pill"
                id="cart-count"
                >0</span
              >
            </button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Shopping Cart -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="shoppingCart"
      aria-labelledby="shoppingCartLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shoppingCartLabel">Shopping Cart</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div class="shopping-cart" id="cart-items">
          <!-- Cart items will be dynamically added here -->
          
        </div>
        <div class="total-price" id="total-price">Total: Rp. 0</div>

        <div class="row">
          <div class="col-sm-9">
            <div class="form-group">
              <label>Nama</label>
              <input
                type="text"
                name="nama"
                class="form-control"
                placeholder="Nama"
              />
            </div>
          </div>
          <div class="row">
            <div class="col-sm-10">
              <div class="form-group">
                <label>Alamat Rumah :</label>
                <textarea
                  class="form-control"
                  name="alamat_rumah"
                  rows="2"
                  id="alamat"
                ></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="form-group">
              <label>email</label>
              <input
                type="text"
                name="email"
                class="form-control"
                placeholder="email "
              />
            </div>
          </div>
          <div class="row">
            <div class="col-sm-10">
              <div class="form-group">
                <label>No.Telp </label>
                <input
                  type="text"
                  name="no"
                  class="form-control"
                  placeholder="No Telp"
                />
              </div>
            </div>
          </div>
        </div>

        <button class="checkout-button" id="checkout-button">Checkout</button>
      </div>
    </div>
<!-- Header-->
<header class="bg-dark position-relative">
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="img/bg1.jpg" class="d-block w-100" alt="Buket Bunga 1">
        <div class="carousel-caption d-none d-md-block animate_animated animate_fadeInDown">
          <h1 class="display-4 fw-bold">Takadoin.Aj</h1>
          <p class="lead">Temukan dan pesan bunga terbaik untuk momen spesial Anda.<br>Pengiriman cepat & kualitas terjamin!</p>
          <a href="#produk" class="btn btn-warning btn-lg mt-3"><i class="bi bi-flower1"></i> Lihat Produk</a>
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="img/bg2.jpg" class="d-block w-100" alt="Buket Bunga 2">
        <div class="carousel-caption d-none d-md-block animate_animated animate_fadeInDown">
          <h1 class="display-4 fw-bold">Promo Juni!</h1>
          <p class="lead">Diskon 10% untuk pembelian di atas Rp. 500.000!</p>
          <a href="#shoppingCart" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" class="btn btn-outline-light btn-lg mt-3"><i class="bi bi-cart"></i> Lihat Keranjang</a>
        </div>
      </div>
      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="img/bg3.jpg" class="d-block w-100" alt="Buket Bunga 3">
        <div class="carousel-caption d-none d-md-block animate_animated animate_fadeInDown">
          <h1 class="display-4 fw-bold">Bunga Segar Setiap Hari</h1>
          <p class="lead">Koleksi bunga premium, siap dikirim ke seluruh Indonesia.</p>
          <a href="#produk" class="btn btn-success btn-lg mt-3"><i class="bi bi-bag-heart"></i> Pesan Sekarang</a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Selanjutnya</span>
    </button>
  </div>
</header>

<!-- Section Produk -->
<section class="py-5" id="produk">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="text-center mb-5 fw-bold text-dark animate_animated animate_fadeInDown"><i class="bi bi-flower1"></i> Katalog Bunga</h2>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
      <?php while($row = mysqli_fetch_assoc($produk)): ?>
      <div class="col mb-5">
        <div class="card h-100 shadow-sm border-0 animate_animated animate_fadeInUp">
          <?php if($row['status'] == 'sale'): ?>
            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
              Sale
            </div>
          <?php endif; ?>
          <img class="card-img-top" src="img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" style="height:220px;object-fit:cover;" />
          <div class="card-body p-4">
            <div class="text-center">
              <h5 class="fw-bolder"><?= htmlspecialchars($row['nama']) ?></h5>
              <?php if(!empty($row['rating'])): ?>
              <div class="d-flex justify-content-center small text-warning mb-2">
                <?php for($i=0;$i<$row['rating'];$i++): ?>
                  <div class="bi-star-fill"></div>
                <?php endfor; ?>
              </div>
              <?php endif; ?>
              <?php if($row['status'] == 'sale' && $row['harga_diskon']): ?>
                <span class="text-muted text-decoration-line-through">Rp. <?= number_format($row['harga'],0,',','.') ?></span>
                <span class="fw-bold text-danger ms-2">Rp. <?= number_format($row['harga_diskon'],0,',','.') ?></span>
              <?php else: ?>
                <span class="fw-bold text-dark">Rp. <?= number_format($row['harga'],0,',','.') ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
              <button
                class="btn btn-outline-dark mt-auto add-to-cart"
                data-product="<?= htmlspecialchars($row['nama']) ?>"
                data-price="<?= $row['status']=='sale' && $row['harga_diskon'] ? $row['harga_diskon'] : $row['harga'] ?>"
                data-image="img/<?= htmlspecialchars($row['gambar']) ?>"
              >
                <i class="bi bi-cart-plus"></i> Add to cart
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">
          Copyright &copy; Your Website 2023
          <!-- Link admin login tersembunyi -->
          <a href="admin/login.php" style="color:transparent; font-size:1px;" tabindex="-1" aria-hidden="true">Admin</a>
        </p>
      </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/kranjang.js"></script>
    <script>
      $(document).ready(function () {
  $('#checkout-button').on('click', function () {
    // Ambil data user
    var nama = $('input[name="nama"]').val();
    var alamat = $('textarea[name="alamat_rumah"]').val();
    var email = $('input[name="email"]').val();
    var no = $('input[name="no"]').val();

    // Validasi sederhana
    if (!nama || !alamat || !email || !no) {
      alert('Mohon lengkapi data diri Anda!');
      return;
    }

    // Ambil data produk dari keranjang
    var produk = [];
    $('#cart-items .cart-item').each(function () {
      var namaProduk = $(this).find('.fw-bold').text();
      var harga = $(this).find('.text-secondary').text();
      var gambar = $(this).find('img').attr('src');
      produk.push({ nama: namaProduk, harga: harga, gambar: gambar });
    });

    if (produk.length === 0) {
      alert('Keranjang masih kosong!');
      return;
    }

    var total = $('#total-price').text().replace(/[^0-9]/g, '');

    // Kirim ke backend
    $.ajax({
      url: 'api/simpan_pesanan.php',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        nama: nama,
        alamat_rumah: alamat,
        email: email,
        no: no,
        produk: JSON.stringify(produk),
        total: total
      }),
      success: function (response) {
        try {
          // Coba parse response jika berupa JSON
          var res = typeof response === 'string' ? JSON.parse(response) : response;
          
          if (res.success || res.status === 'success') {
            alert('Pesanan berhasil dikirim!');
            // Kosongkan keranjang
            localStorage.removeItem('cart');
            $('#cart-items').empty();
            $('#cart-count').text('0');
            $('#total-price').text('Total: Rp. 0');
            // Reset form
            $('input[name="nama"], textarea[name="alamat_rumah"], input[name="email"], input[name="no"]').val('');
          } else {
            alert(res.message || 'Pesanan berhasil disimpan tetapi respons tidak terduga');
          }
        } catch (e) {
          // Jika response bukan JSON, anggap berhasil jika HTTP status 200
          alert('Pesanan berhasil dikirim!');
          location.reload();
        }
      },
      error: function (xhr, status, error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim pesanan. Silakan coba lagi.');
      }
    });
  });
});
    </script>
  </body>
</html>