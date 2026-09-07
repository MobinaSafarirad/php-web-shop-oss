<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: products.php');
    exit;
}
require_once '../includes/db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND role = 1";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password == $user['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header('Location: products.php');
            exit;
        } else {
            $error = 'Incorrect password';
        }
    } else {
        $error = 'Admin username not found';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="login-box">
        <h2>Admin Panel</h2>
        <a href="../index.php" class="back-link">← Back to Shop</a>
        <?php if ($error != ''): ?>
            <p style="color: red; background: #ffe0e0; padding: 8px; border-radius: 8px;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" class="font-input" name="username" placeholder="Username" required autofocus><br>
            <input type="password" class="font-input" name="password" placeholder="Password" required><br>
            <button type="submit" class="submit-btn" style="padding: 5px; border-radius: 5px">Login</button>
        </form>
        <p style="margin-top: 15px; font-size: 0.8rem;">(Default: myshop_user / 1234)</p>
    </div>
</body>

</html>