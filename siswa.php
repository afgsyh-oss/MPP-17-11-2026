<?php
require_once 'functions.php';
require_role('siswa');
page_header('Dashboard Siswa');
?>
<div class="p-4 p-md-5 bg-white rounded-3 shadow-sm">
 <span class="badge text-bg-warning mb-3">Role: SISWA</span>
 <h1 class="h3">Dashboard Siswa</h1>
 <p class="text-secondary mb-4">Selamat datang, <strong><?= e($_SESSION['nama']) ?></strong>.</p>
 <p>Anda dapat melihat informasi dan mengelola profil akun sendiri.</p>
 <div class="d-flex flex-wrap gap-2"><a class="btn btn-outline-primary" href="profil.php">Lihat Profil</a>
 </div>
</div>
<?php page_footer(); ?>
