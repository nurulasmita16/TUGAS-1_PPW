<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sports_store");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambahkan produk jika belum ada
$default_products = [
    ['name' => 'Bola Voli', 'description' => 'Bola voli berkualitas tinggi untuk turnamen.', 'price' => 750000],
    ['name' => 'Jaket Olahraga', 'description' => 'Jaket sporty nyaman dan stylish.', 'price' => 250000],
    ['name' => 'Alat Gym', 'description' => 'Peralatan gym untuk latihan di rumah.', 'price' => 500000],
    ['name' => 'Sepatu Lari', 'description' => 'Sepatu lari ringan dan nyaman.', 'price' => 600000],
    ['name' => 'Raket Badminton', 'description' => 'Raket ringan dan kokoh.', 'price' => 400000]
];

foreach ($default_products as $product) {
    $check_sql = "SELECT * FROM products WHERE name = '" . $product['name'] . "'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows == 0) {
        $insert_sql = "INSERT INTO products (name, description, price) VALUES ('" . $product['name'] . "', '" . $product['description'] . "', " . $product['price'] . ")";
        $conn->query($insert_sql);
    }
}

// Ambil daftar produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportStore - Perlengkapan Olahraga</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #ffffff, #80bfff);
            text-align: center;
            margin: 0;
            color: #002855;
        }

        header {
            background:linear-gradient(to right, #4da6ff,rgb(102, 149, 196));
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
            justify-items: center;
            max-width: 90%;
            margin: 0 auto;
        }

        .product {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            padding: 20px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .description {
            color: #333;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background: rgba(240, 240, 240, 0.8);
            border-radius: 8px;
        }

        .buy-btn {
            background: linear-gradient(to right, #4da6ff, #00509e);
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            display: inline-block;
            margin-top: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .buy-btn:hover {
            background: linear-gradient(to right, #00509e, #002855);
        }

        footer {
            background: linear-gradient(to right, #4da6ff,rgb(102, 149, 196));
            padding: 15px;
            margin-top: 20px;
            font-size: 14px;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>🏅 Selamat Datang di SportStore</h1>
        <p>🏋️‍♂️ Temukan perlengkapan olahraga terbaik dengan harga terjangkau! ⚽</p>
    </header>
    <main>
        <section class="product-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="product">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h2><?php echo $row['name']; ?></h2>
                    <p class="description"><?php echo $row['description']; ?></p>
                    <p class="price">💰 Rp<?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                    <a href="order_process.php?id=<?php echo $row['id']; ?>" class="buy-btn">🛒 Pesan Sekarang</a>
                </div>

            <?php } ?>
        </section>
    </main>
    <footer>
        <p>📞 082153803408 (MITA) | 📧 support@sportstore.com | 📱 @nurulasmita_ 📱 @sportstore_id</p>
        <p>🙏 Terima kasih telah berbelanja di SportStore! Semoga olahraga Anda menyenangkan! ⚡</p>
        <p>❗ Apabila terjadi kesalahan pada website ini, silakan hubungi akun media sosial admin yang tertera di atas. Kami siap membantu Anda! 😊</p>
    </footer>
</body>
</html>
