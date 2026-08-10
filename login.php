<?php
session_start();
if (isset($_SESSION['user'])) { header("Location: dashboard.php"); exit; }

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Demo account. Replace with users table + password_hash/password_verify in production.
    if ($email === 'admin@example.com' && $password === 'admin123') {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id'=>1, 'name'=>'Admin', 'email'=>$email, 'role'=>'admin'];
        header("Location: dashboard.php");
        exit;
    }
    $error = "Invalid email or password.";
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>SmartLink • Login</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
<div class="login-shell">
  <div class="brand-mark">S</div>
  <h1>SmartLink</h1>
  <p class="muted">Tracking & analytics platform</p>
  <?php if ($error): ?><div class="alert danger"><?= e($error) ?></div><?php endif; ?>
  <form method="post" class="login-card">
    <label>Email</label>
    <input type="email" name="email" value="admin@example.com" required>
    <label>Password</label>
    <input type="password" name="password" value="admin123" required>
    <button class="btn primary full">Sign in</button>
    <div class="demo-note">Demo: admin@example.com / admin123</div>
  </form>
</div>
</body>
</html>