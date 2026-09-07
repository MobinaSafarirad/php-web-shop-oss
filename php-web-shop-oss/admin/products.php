<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db_connect.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="admin-container">
        <h1>Manage Products</h1>
        <a href="../index.php" class="back-link">← Back to Shop</a>
        <div style="margin-bottom: 20px;">
            <a href="add_product.php" class="btn">➕ Add New Product</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>

        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Price (USD)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['pro_code']; ?></td>
                        <td><?php echo htmlspecialchars($row['pro_name']); ?></td>
                        <td><?php echo $row['pro_qty']; ?></td>
                        <td><?php echo number_format($row['pro_price']); ?></td>
                        <td>
                            <a href="edit_product.php?code=<?php echo $row['pro_code']; ?>" class="btn-small">✏️ Edit</a>
                            <a href="delete_product.php?code=<?php echo $row['pro_code']; ?>"
                               onclick="return confirm('Are you sure you want to delete this product?')"
                               class="btn-small btn-danger">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>