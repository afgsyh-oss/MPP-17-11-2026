<?php
require_once 'functions.php';
require_role('admin');
page_header('Dashboard Administrator');
?>
<div class="p-4 p-md-5 bg-white rounded-3 shadow-sm">
 <span class="badge text-bg-primary mb-3">Role: ADMIN</span>
 <h1 class="h3">Dashboard Administrator</h1>
 <p class="text-secondary mb-4">Selamat datang, <strong><?= e($_SESSION['nama']) ?></strong>.</p>
 <p>Anda memiliki hak akses untuk mengelola pengguna dan seluruh fitur aplikasi.</p>
 <div class="d-flex flex-wrap gap-2"><a class="btn btn-outline-primary" href="profil.php">Lihat Profil</a>
 <a class="btn btn-primary" href="kelola_user.php">Kelola Pengguna</a></div>
</div>
<?php page_footer(); ?>
