<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
require_once '../includes/db_connect.php';

$pro_code = isset($_GET['code']) ? (int) $_GET['code'] : 0;
if ($pro_code == 0) {
    header('Location: products.php');
    exit;
}

$sql = "SELECT * FROM products WHERE pro_code = $pro_code";
$result = mysqli_query($link, $sql);
$product = mysqli_fetch_assoc($result);
if (!$product) {
    header('Location: products.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pro_name = mysqli_real_escape_string($link, $_POST['pro_name']);
    $pro_detail = mysqli_real_escape_string($link, $_POST['pro_detail']);
    $pro_qty = (int) $_POST['pro_qty'];
    $pro_price = (float) $_POST['pro_price'];

    $pro_image = $product['pro_image'];
    if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error'] == 0) {
        $ext = pathinfo($_FILES['pro_image']['name'], PATHINFO_EXTENSION);
        $new_name = time() . '_' . rand(1000, 9999) . '.' . $ext;
        $target = '../images/' . $new_name;
        if (move_uploaded_file($_FILES['pro_image']['tmp_name'], $target)) {
            $pro_image = 'images/' . $new_name;
        } else {
            $message = '<span style="color:red;">Error uploading new image</span>';
        }
    }

    $sql_update = "UPDATE products SET 
                    pro_name = '$pro_name',
                    pro_detail = '$pro_detail',
                    pro_qty = $pro_qty,
                    pro_price = $pro_price,
                    pro_image = '$pro_image'
                  WHERE pro_code = $pro_code";

    if (mysqli_query($link, $sql_update)) {
        $message = '<span style="color:green;">Product updated successfully.</span>';
        $result = mysqli_query($link, "SELECT * FROM products WHERE pro_code = $pro_code");
        $product = mysqli_fetch_assoc($result);
    } else {
        $message = '<span style="color:red;">Error updating: ' . mysqli_error($link) . '</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="form-container">
        <h2>✏️ Edit Product (Code <?php echo $pro_code; ?>)</h2>
        <?php if ($message != ''): ?>
            <div><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="pro_name" value="<?php echo htmlspecialchars($product['pro_name']); ?>" required><br>
            <textarea name="pro_detail" rows="4" style="width:100%;"><?php echo htmlspecialchars($product['pro_detail']); ?></textarea><br>
            <input type="number" name="pro_qty" value="<?php echo $product['pro_qty']; ?>" required><br>
            <input type="number" step="1" name="pro_price" value="<?php echo $product['pro_price']; ?>" required><br>

            <div>
                <strong>Current Image:</strong><br>
                <img src="../<?php echo $product['pro_image']; ?>" style="max-width: 150px; max-height: 150px;"><br>
                <small>Path: <?php echo $product['pro_image']; ?></small>
            </div>
            <br>
            <input type="file" name="pro_image" accept="image/*"><br>
            <small>To change image, select a new file (optional)</small><br><br>

            <button type="submit" class="btn">Save Changes</button>
            <a href="products.php" class="btn logout">Cancel</a>
        </form>
    </div>
</body>

</html>