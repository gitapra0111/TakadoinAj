<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape semua input
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat_rumah']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no = mysqli_real_escape_string($conn, $_POST['no']);
    $produk_input = $_POST['produk'];
    $total = mysqli_real_escape_string($conn, $_POST['total']);

    // Parsing produk dan upload gambar
    $produk_arr = [];
    $produk_list = explode(',', $produk_input);
    foreach ($produk_list as $i => $item) {
        preg_match('/(.*)\((.*)\)/', trim($item), $matches);
        $nama_produk = isset($matches[1]) ? trim($matches[1]) : '';
        $harga_produk = isset($matches[2]) ? trim($matches[2]) : '';
        $gambar_produk = '';
        if (!empty($_FILES['gambar_produk']['name'][$i])) {
            $filename = $_FILES['gambar_produk']['name'][$i];
            $tmp = $_FILES['gambar_produk']['tmp_name'][$i];
            move_uploaded_file($tmp, "../img/$filename");
            $gambar_produk = "img/$filename";
        }
        $produk_arr[] = [
            'nama' => $nama_produk,
            'harga' => $harga_produk,
            'gambar' => $gambar_produk
        ];
    }

    $produk_json = mysqli_real_escape_string($conn, json_encode($produk_arr));
    $sql = "INSERT INTO pesanan (nama, alamat_rumah, email, no, produk, total) VALUES ('$nama', '$alamat', '$email', '$no', '$produk_json', '$total')";
    mysqli_query($conn, $sql);
    header("Location: adminpesanan.php");
    exit;
}
?>