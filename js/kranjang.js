$(document).ready(function () {
  let cart = [];

  // Fungsi render keranjang
  function renderCart() {
    let $cart = $("#cart-items");
    $cart.empty();
    let total = 0;

    if (cart.length === 0) {
      $cart.html('<div class="text-center text-muted">Keranjang kosong</div>');
    } else {
      cart.forEach((item, idx) => {
        total += Number(item.price);
        $cart.append(`
          <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-2">
            <div class="d-flex align-items-center">
              <img src="${item.image}" alt="${item.product}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;margin-right:10px;">
              <div>
                <div class="fw-bold">${item.product}</div>
                <div class="text-secondary small">Rp. ${Number(item.price).toLocaleString("id-ID")}</div>
              </div>
            </div>
            <button class="btn btn-sm btn-danger remove-item" data-idx="${idx}"><i class="bi bi-trash"></i></button>
          </div>
        `);
      });
    }

    $("#cart-count").text(cart.length);
    $("#total-price").html(`Total: <b>Rp. ${total.toLocaleString("id-ID")}</b>`);
  }

  // Tambah produk ke keranjang
  $(".add-to-cart").on("click", function () {
    const product = $(this).data("product");
    let price = $(this).data("price");
    // Hilangkan karakter selain angka
    price = String(price).replace(/[^0-9]/g, "");
    const image = $(this).data("image");
    cart.push({ product, price, image });
    renderCart();
  });

  // Hapus produk dari keranjang
  $("#cart-items").on("click", ".remove-item", function () {
    const idx = $(this).data("idx");
    cart.splice(idx, 1);
    renderCart();
  });

  // Kirim ke WhatsApp saat checkout
  $("#checkout-button").on("click", function () {
    if (cart.length === 0) {
      alert("Keranjang masih kosong!");
      return;
    }
    let nama = $('input[name="nama"]').val();
    let alamat = $('textarea[name="alamat_rumah"]').val();
    let email = $('input[name="email"]').val();
    let no = $('input[name="no"]').val();

    let pesan = `*Order Takadoin.Aj*\n\n`;
    cart.forEach((item, i) => {
      pesan += `${i + 1}. ${item.product} - Rp. ${Number(item.price).toLocaleString("id-ID")}\n`;
    });
    pesan += `\nTotal: Rp. ${cart.reduce((a, b) => a + Number(b.price), 0).toLocaleString("id-ID")}\n\n`;
    pesan += `Nama: ${nama}\nAlamat: ${alamat}\nEmail: ${email}\nNo.Telp: ${no}`;

    // Ganti nomor berikut dengan nomor WhatsApp tujuan
    let nomorWA = "6282317996089";
    let url = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;
    window.open(url, "_blank");
  });

  // Responsive: scroll jika item banyak
  $("#cart-items").css({
    "max-height": "250px",
    "overflow-y": "auto",
  });

  renderCart();
});