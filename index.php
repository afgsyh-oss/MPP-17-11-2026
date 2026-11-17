<?php
require_once 'functions.php';
if (!empty($_SESSION['user_id'])) redirect('dashboard.php');
page_header('Login');
?>
<div class="row justify-content-center align-items-center" style="min-height:70vh"><div class="col-md-5 col-lg-4">
<div class="card border-0 shadow-sm"><div class="card-body p-4">
<h2 class="text-center mb-1">Login Pengguna</h2><p class="text-secondary text-center mb-4">Masuk menggunakan akun yang terdaftar</p>
<?php if (isset($_GET['error'])): ?><div class="alert alert-danger">Username atau password salah.</div><?php endif; ?>
<form action="proses_login.php" method="post">
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" autocomplete="username" required autofocus></div>
<div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" autocomplete="current-password" required></div>
<button class="btn btn-primary w-100">Login</button>
</form></div></div>
<div class="small text-secondary mt-3">Akun contoh tersedia setelah menjalankan <code>buat_user.php</code>. Hapus file tersebut setelah selesai.</div>
</div></div>
<?php page_footer(); ?>
