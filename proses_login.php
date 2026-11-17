<?php
require_once 'functions.php';
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php');
verify_csrf();
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$stmt = $koneksi->prepare('SELECT id,nama,username,password,role FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    redirect('dashboard.php');
}
redirect('index.php?error=1');
