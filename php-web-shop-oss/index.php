<?php
require_once 'includes/db_connect.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';

switch ($sort) {
    case 'price_asc':
        $orderBy = 'pro_price ASC';
        break;
    case 'price_desc':
        $orderBy = 'pro_price DESC';
        break;
    case 'name_desc':
        $orderBy = 'pro_name DESC';
        break;
    default:
        $orderBy = 'pro_name ASC';
}

$sql = "SELECT * FROM products 
        WHERE pro_name LIKE '%$search%' OR pro_detail LIKE '%$search%' 
        ORDER BY $orderBy";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Educational Products Store</title>
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

    <div class="container">

        <!-- LEFT: Shopping Cart -->
        <aside class="cart-sidebar">
            <h2>🛒 Shopping Cart</h2>
            <div id="cart-items"></div>
            <div id="cart-total">Total: 0 $</div>
            <div id="checkout-form">
                <input type="text" class="font-input" id="customer-name" placeholder="Full Name" required>
                <input type="email" class="font-input" id="customer-email" placeholder="Email" required>
                <input type="text" class="font-input" id="customer-mobile" placeholder="Mobile Number" required>
                <textarea rows="1" wrap="virtual" class="font-input" style="width:100%;" id="customer-address"
                    placeholder="Full Address" required></textarea>
                <button id="place-order-btn" class="submit-btn">Place Order</button>
            </div>
            <div id="order-message"></div>
        </aside>

        <!-- MIDDLE: Products Grid (3 columns) -->
        <main class="products-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-card" data-id="<?php echo $row['pro_code']; ?>"
                    data-name="<?php echo htmlspecialchars($row['pro_name']); ?>"
                    data-price="<?php echo $row['pro_price']; ?>">
                    <a href="product.php?code=<?php echo $row['pro_code']; ?>"
                        style="text-decoration: none; color: inherit;">
                        <img src="<?php echo $row['pro_image']; ?>" alt="Product"
                            style="width:100%; height:150px; object-fit:contain;">
                        <h3><?php echo htmlspecialchars($row['pro_name']); ?></h3>
                    </a>
                    <p><?php echo htmlspecialchars(substr($row['pro_detail'], 0, 80)); ?>...</p>
                    <span class="price"><?php echo number_format($row['pro_price']); ?> $</span>
                    <button class="add-to-cart">➕ Add to Cart</button>
                </div>
            <?php endwhile; ?>
        </main>

        <!-- RIGHT: Sorting box (replaces cart) -->
        <aside class="filters">
            <form method="GET" action="index.php">
                <input type="text" name="search" placeholder="Search products..."
                    value="<?php echo htmlspecialchars($search); ?>">
                <select name="sort" onchange="this.form.submit()">
                    <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>Sort by: Name (A-Z)</option>
                    <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>Sort by: Name (Z-A)</option>
                    <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Sort by: Price (Low to High)</option>
                    <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Sort by: Price (High to Low)</option>
                </select>
            </form>
        </aside>

    </div>

    <script src="js/cart.js"></script>
</body>

</html>