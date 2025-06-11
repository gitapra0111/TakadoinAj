<?php
include('../koneksi.php');
$data = json_decode(file_get_contents('php://input'), true);

$nama = mysqli_real_escape_string($conn, $data['nama']);
$alamat = mysqli_real_escape_string($conn, $data['alamat_rumah']);
$email = mysqli_real_escape_string($conn, $data['email']);
$no = mysqli_real_escape_string($conn, $data['no']);
$produk = mysqli_real_escape_string($conn, $data['produk']); // JSON string
$total = intval($data['total']);

$sql = "INSERT INTO pesanan (nama, alamat_rumah, email, no, produk, total) VALUES ('$nama', '$alamat', '$email', '$no', '$produk', '$total')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>