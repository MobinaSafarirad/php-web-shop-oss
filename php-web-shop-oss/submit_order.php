<?php
require_once 'includes/db_connect.php';
header('Content-Type: application/json');

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);

if (!$data || !isset($data['customer_name']) || !isset($data['customer_email']) || !isset($data['customer_mobile']) || !isset($data['customer_address']) || !isset($data['cart'])) {
    echo json_encode(['success' => false, 'error' => 'Incomplete information']);
    exit;
}

$customer_name = mysqli_real_escape_string($link, $data['customer_name']);
$customer_email = mysqli_real_escape_string($link, $data['customer_email']);
$customer_mobile = mysqli_real_escape_string($link, $data['customer_mobile']);
$customer_address = mysqli_real_escape_string($link, $data['customer_address']);
$cart = $data['cart'];
$orderdate = date('Y-m-d');

mysqli_begin_transaction($link);

foreach ($cart as $item) {
    $pro_code = (int)$item['id'];
    $pro_qty_order = (int)$item['quantity'];
    $pro_price = (float)$item['price'];

    $sql_check = "SELECT pro_qty FROM products WHERE pro_code = $pro_code";
    $result_check = mysqli_query($link, $sql_check);
    $row = mysqli_fetch_assoc($result_check);
    if (!$row || $row['pro_qty'] < $pro_qty_order) {
        echo json_encode(['success' => false, 'error' => 'Insufficient stock for product code ' . $pro_code]);
        mysqli_rollback($link);
        exit;
    }

    $new_qty = $row['pro_qty'] - $pro_qty_order;
    $sql_update = "UPDATE products SET pro_qty = $new_qty WHERE pro_code = $pro_code";
    if (!mysqli_query($link, $sql_update)) {
        echo json_encode(['success' => false, 'error' => 'Error updating stock']);
        mysqli_rollback($link);
        exit;
    }

    $sql_insert = "INSERT INTO orders (username, orderdate, pro_code, pro_qty, pro_price, pro_mobile, address)
                   VALUES ('$customer_name', '$orderdate', $pro_code, $pro_qty_order, $pro_price, '$customer_mobile', '$customer_address')";
    if (!mysqli_query($link, $sql_insert)) {
        echo json_encode(['success' => false, 'error' => 'Error placing order: ' . mysqli_error($link)]);
        mysqli_rollback($link);
        exit;
    }
}

mysqli_commit($link);
echo json_encode(['success' => true]);
?>