<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
require_once '../includes/db_connect.php';

$pro_code = isset($_GET['code']) ? (int) $_GET['code'] : 0;

if ($pro_code != 0) {
    $sql = "DELETE FROM products WHERE pro_code = $pro_code";
    mysqli_query($link, $sql);
}

header('Location: products.php');
exit;
?>