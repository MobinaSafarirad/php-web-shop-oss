<?php
require_once 'includes/db_connect.php';

$pro_code = isset($_GET['code']) ? (int) $_GET['code'] : 0;

if ($pro_code == 0) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT * FROM products WHERE pro_code = $pro_code";
$result = mysqli_query($link, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['pro_name']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>📚 Educational Products Store</h1>
        <div class="admin-link">
            <a href="aboutUS.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="admin/login.php">Admin Login</a>
        </div>
    </header>

    <div class="product-detail">
        <a href="index.php" class="back-link">← Back to Shop</a>

        <div class="detail-card">
            <img src="<?php echo $product['pro_image']; ?>" alt="<?php echo htmlspecialchars($product['pro_name']); ?>">
            <h2><?php echo htmlspecialchars($product['pro_name']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($product['pro_detail'])); ?></p>
            <div class="price"><?php echo number_format($product['pro_price']); ?> USD</div>

            <div class="stock">
                Stock:
                <?php if ($product['pro_qty'] > 0): ?>
                    <span style="color: green; font-weight: bold;"><?php echo $product['pro_qty']; ?> available</span>
                <?php else: ?>
                    <span style="color: red; font-weight: bold;">Out of Stock</span>
                <?php endif; ?>
            </div>

            <?php if ($product['pro_qty'] > 0): ?>
                <button id="single-add-to-cart" class="add-to-cart" data-id="<?php echo $product['pro_code']; ?>"
                    data-name="<?php echo htmlspecialchars($product['pro_name']); ?>" 
                    data-price="<?php echo $product['pro_price']; ?>">
                    ➕ Add to Cart
                </button>
            <?php else: ?>
                <button class="add-to-cart disabled" disabled style="background:gray; cursor:not-allowed;">
                    ❌ Out of Stock - Not available
                </button>
            <?php endif; ?>

            <script src="js/cart.js"></script>
            <script>
                document.getElementById('single-add-to-cart')?.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');
                    let name = this.getAttribute('data-name');
                    let price = this.getAttribute('data-price');
                    if (typeof addToCart === 'function') {
                        addToCart(id, name, price);
                    } else {
                        console.error('addToCart function not found. Check if cart.js is loaded.');
                    }
                });
            </script>
        </div>
    </div>

</body>

</html>