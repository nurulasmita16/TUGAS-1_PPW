<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sports_store");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data produk berdasarkan ID
$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
if (!$product) {
    die("Produk tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="order-container">
    <h2>🛍️ Form Pemesanan</h2>

    <div class="order-card">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <h2><?php echo $product['name']; ?></h2>
        <p><?php echo $product['description']; ?></p>
        <p class="price">💰 Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
    </div>

    <form action="submit_order.php" method="POST">
        <input type="hidden" name="produk" value="<?php echo htmlspecialchars($product['name']); ?>">

        <label for="nama">👤 Nama Lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>

        <label for="email">📧 Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>

        <label for="nomor_hp">📞 Nomor HP</label>
        <input type="tel" id="nomor_hp" name="nomor_hp" placeholder="Masukkan nomor HP aktif" required>

        <label for="jumlah">🔢 Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" min="1" value="1" required>

        <label for="metode_pembayaran">💳 Metode Pembayaran</label>
        <select id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="Transfer Bank">🏦 Transfer Bank</option>
            <option value="E-Wallet">📱 E-Wallet</option>
            <option value="COD">💵 Cash on Delivery</option>
        </select>

        <label for="catatan">📝 Catatan Tambahan</label>
        <textarea id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika perlu..."></textarea>

        <button type="submit">✅ Pesan Sekarang</button>
    </form>
</div>

</body>
</html>
