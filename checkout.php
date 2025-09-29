<?php
include 'components/connect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : '';
if (!$user_id) {
    header('location:home.php');
    exit;
}

$message = [];

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'] ?? '', FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['method'] ?? '', FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'] ?? '', FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'] ?? '';
    $total_price = (float)($_POST['total_price'] ?? 0);
    $order_type = filter_var($_POST['order_type'] ?? 'delivery', FILTER_SANITIZE_STRING);

    // Validate input
    if (empty($name) || empty($number) || empty($email) || empty($method) || empty($order_type)) {
        $message[] = 'Semua field wajib diisi!';
    } else {
        $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $check_cart->execute([$user_id]);

        if ($check_cart->rowCount() > 0) {
            if ($order_type === 'delivery' && empty($address)) {
                $message[] = 'Masukkan alamat anda untuk pengiriman!';
            } else {
                // Set address to empty for dine-in
                if ($order_type === 'dine-in') {
                    $address = '';
                }

                try {
                    $conn->beginTransaction();
                    $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, order_type) VALUES(?,?,?,?,?,?,?,?,?)");
                    $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price, $order_type]);

                    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
                    $delete_cart->execute([$user_id]);

                    $conn->commit();
                    $message[] = 'Pesanan berhasil di checkout';
                } catch (PDOException $e) {
                    $conn->rollBack();
                    $message[] = 'Gagal memproses pesanan: ' . $e->getMessage();
                }
            }
        } else {
            $message[] = 'Keranjangmu kosong';
        }
    }
}

// Fetch cart items and calculate total in one go
$grand_total = 0;
$cart_items = [];
$total_products = '';
$select_cart = $conn->prepare("SELECT name, price, quantity FROM `cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);
$cart_data = $select_cart->fetchAll(PDO::FETCH_ASSOC);

if (!empty($cart_data)) {
    foreach ($cart_data as $item) {
        $cart_items[] = $item['name'] . ' (' . $item['price'] . ' x ' . $item['quantity'] . ') - ';
        $grand_total += ($item['price'] * $item['quantity']);
    }
    $total_products = implode('', $cart_items);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- font awesome cdn link with async for faster loading -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" async>

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
    <h3>Checkout</h3>
    <p><a href="home.php">Beranda</a> <span> / checkout</span></p>
</div>

<section class="checkout">
    <h1 class="title">Total Pesanan</h1>

    <?php if (!empty($message) && is_array($message)): ?>
    <div class="message-box">
        <?php foreach ($message as $msg): ?>
            <p><?= htmlspecialchars($msg) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="cart-items">
            <h3>Produk Keranjang</h3>
            <?php if (!empty($cart_data)): ?>
                <?php foreach ($cart_data as $fetch_cart): ?>
                    <p><span class="name"><?= htmlspecialchars($fetch_cart['name']) ?></span><span class="price">Rp.<?= number_format($fetch_cart['price'], 0, ',', '.') ?> x <?= $fetch_cart['quantity'] ?></span></p>
                <?php endforeach; ?>
                <p class="grand-total"><span class="name">Total:</span><span class="price">Rp.<?= number_format($grand_total, 0, ',', '.') ?></span></p>
                <a href="cart.php" class="btn">Cek Keranjang</a>
            <?php else: ?>
                <p class="empty">Keranjangmu kosong!</p>
            <?php endif; ?>
        </div>

        <input type="hidden" name="total_products" value="<?= htmlspecialchars($total_products) ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_profile['name'] ?? '') ?>">
        <input type="hidden" name="number" value="<?= htmlspecialchars($fetch_profile['number'] ?? '') ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($fetch_profile['email'] ?? '') ?>">

        <div class="user-info">
            <h3>Informasi Anda</h3>
            <p><i class="fas fa-user"></i><span><?= htmlspecialchars($fetch_profile['name'] ?? 'N/A') ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= htmlspecialchars($fetch_profile['number'] ?? 'N/A') ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= htmlspecialchars($fetch_profile['email'] ?? 'N/A') ?></span></p>
            <a href="update_profile.php" class="btn">Informasi Terbaru</a>

            <h3>Jenis Pesanan</h3>
            <div class="order-type">
                <label><input type="radio" name="order_type" value="delivery" checked onclick="toggleAddressFields()"> Pengiriman</label>
                <label><input type="radio" name="order_type" value="dine-in" onclick="toggleAddressFields()"> Makan di Tempat</label>
            </div>

            <div id="address-section">
                <h3>Alamat Pengiriman</h3>
                <p><i class="fas fa-map-marker-alt"></i><span id="address-display"><?php echo empty($fetch_profile['address']) ? 'Mohon masukkan alamat anda' : htmlspecialchars($fetch_profile['address']); ?></span></p>
                <input type="hidden" name="address" id="address-input" value="<?= htmlspecialchars($fetch_profile['address'] ?? '') ?>">
                <a href="update_address.php" class="btn" id="update-address-btn">Alamat Pengiriman Terbaru</a>
            </div>

            <h3>Metode Pembayaran</h3>
            <select name="method" class="box" required>
                <option value="" disabled selected>Pilih metode pembayaran --</option>
                <option value="Cash On Delivery">Cash On Delivery</option>
                <option value="Dana/Ovo">Dana/Ovo</option>
            </select>
            <input type="submit" value="Melakukan Pemesanan" class="btn <?php echo (empty($fetch_profile['address']) && (!isset($_POST['order_type']) || $_POST['order_type'] === 'delivery')) ? 'disabled' : ''; ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
        </div>
    </form>
</section>

<!-- footer section starts -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link -->
<script src="js/script.js" defer></script>
<script>
function toggleAddressFields() {
    const delivery = document.querySelector('input[name="order_type"][value="delivery"]').checked;
    const addressSection = document.getElementById('address-section');
    const addressInput = document.getElementById('address-input');
    const updateAddressBtn = document.getElementById('update-address-btn');
    const submitBtn = document.querySelector('input[name="submit"]');

    addressSection.style.display = delivery ? 'block' : 'none';
    addressInput.disabled = !delivery;
    updateAddressBtn.style.display = delivery ? 'inline-block' : 'none';
    submitBtn.classList.toggle('disabled', delivery && !addressInput.value);
}

document.addEventListener('DOMContentLoaded', toggleAddressFields);
</script>
</body>
</html>