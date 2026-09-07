<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
require_once '../includes/db_connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pro_name = mysqli_real_escape_string($link, $_POST['pro_name']);
    $pro_detail = mysqli_real_escape_string($link, $_POST['pro_detail']);
    $pro_qty = (int) $_POST['pro_qty'];
    $pro_price = (float) $_POST['pro_price'];

    $pro_image = '';
    if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error'] == 0) {
        $ext = pathinfo($_FILES['pro_image']['name'], PATHINFO_EXTENSION);
        $new_name = time() . '_' . rand(1000, 9999) . '.' . $ext;
        $target = '../images/' . $new_name;
        if (move_uploaded_file($_FILES['pro_image']['tmp_name'], $target)) {
            $pro_image = 'images/' . $new_name;
        } else {
            $message = '<span style="color:red;">Error uploading image</span>';
        }
    }

    $sql = "INSERT INTO products (pro_name, pro_detail, pro_qty, pro_price, pro_image)
            VALUES ('$pro_name', '$pro_detail', $pro_qty, $pro_price, '$pro_image')";

    if (mysqli_query($link, $sql)) {
        $message = '<span style="color:green;">Product added successfully.</span>';
    } else {
        $message = '<span style="color:red;">Error: ' . mysqli_error($link) . '</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="form-container">
        <h2>➕ Add New Product</h2>
        <?php if ($message != ''): ?>
            <div><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="pro_name" placeholder="Product Name" required><br>
            <textarea name="pro_detail" placeholder="Product Description" rows="4" style="width:100%;"></textarea><br>
            <input type="number" name="pro_qty" placeholder="Stock Quantity" required><br>
            <input type="number" step="1" name="pro_price" placeholder="Price (USD)" required><br>

            <h4>Select Product Image</h4>
            <input type="file" name="pro_image" accept="image/*"><br>
            <small>Image file (jpg, png, gif)</small><br><br>
            <button type="submit" class="btn">Save Product</button>
            <a href="products.php" class="btn logout">Back</a>
        </form>
    </div>
</body>

</html>