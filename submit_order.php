<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sports_store");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$nomor_hp = $_POST['nomor_hp'] ?? '';
$produk = $_POST['produk'] ?? '';
$jumlah = $_POST['jumlah'] ?? 1;
$metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
$catatan = $_POST['catatan'] ?? '';

// Cek apakah data kosong
if (!$nama || !$email || !$nomor_hp || !$produk || !$jumlah || !$metode_pembayaran) {
    die("Semua field harus diisi!");
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO orders (nama, email, nomor_hp, produk, jumlah, metode_pembayaran, catatan) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $nama, $email, $nomor_hp, $produk, $jumlah, $metode_pembayaran, $catatan);

if ($stmt->execute()) {
    echo "<script>alert('Pemesanan berhasil!'); window.location.href='index.php';</script>";
} else {
    echo "Gagal menyimpan data: " . $conn->error;
}

$stmt->close();
$conn->close();
?>