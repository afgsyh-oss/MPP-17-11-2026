<?php
require_once 'functions.php';
require_role('petugas');
page_header('Dashboard Petugas');
?>
<div class="p-4 p-md-5 bg-white rounded-3 shadow-sm">
 <span class="badge text-bg-success mb-3">Role: PETUGAS</span>
 <h1 class="h3">Dashboard Petugas</h1>
 <p class="text-secondary mb-4">Selamat datang, <strong><?= e($_SESSION['nama']) ?></strong>.</p>
 <p>Anda dapat mengakses halaman operasional sesuai kewenangan petugas.</p>
 <div class="d-flex flex-wrap gap-2"><a class="btn btn-outline-primary" href="profil.php">Lihat Profil</a>
 </div>
</div>
<?php page_footer(); ?>
