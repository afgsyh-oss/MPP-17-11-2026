<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    session_start();
}

function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
function redirect(string $url): never {
    header("Location: {$url}");
    exit;
}
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function verify_csrf(): void {
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(419);
        exit('Permintaan tidak valid atau sesi formulir telah kedaluwarsa. Muat ulang halaman.');
    }
}
function flash(string $key, ?string $message = null): ?string {
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }
    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $value;
}
function require_login(): void {
    if (empty($_SESSION['user_id'])) redirect('index.php');
}
function require_role(string ...$roles): void {
    require_login();
    if (!in_array($_SESSION['role'] ?? '', $roles, true)) {
        http_response_code(403);
        exit('403 - Anda tidak memiliki hak akses untuk halaman ini.');
    }
}
function page_header(string $title): void { ?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> - Login Hak Akses</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container"><a class="navbar-brand fw-semibold" href="dashboard.php">Login Hak Akses</a>
 <?php if (!empty($_SESSION['user_id'])): ?>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
 <div class="collapse navbar-collapse" id="nav"><div class="navbar-nav ms-auto">
 <a class="nav-link" href="dashboard.php">Dashboard</a><a class="nav-link" href="profil.php">Profil</a>
 <?php if (($_SESSION['role'] ?? '') === 'admin'): ?><a class="nav-link" href="kelola_user.php">Kelola Pengguna</a><?php endif; ?>
 <a class="nav-link" href="logout.php">Logout</a></div></div>
 <?php endif; ?>
 </div></nav><main class="container py-4">
 <?php if ($m = flash('success')): ?><div class="alert alert-success"><?= e($m) ?></div><?php endif; ?>
 <?php if ($m = flash('error')): ?><div class="alert alert-danger"><?= e($m) ?></div><?php endif; ?>
<?php }
function page_footer(): void { ?>
</main><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>
<?php }
