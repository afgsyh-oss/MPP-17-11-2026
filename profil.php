<?php
require_once 'functions.php';
require_login();
page_header('Profil Pengguna');
?>
<div class="row justify-content-center"><div class="col-lg-7"><div class="card border-0 shadow-sm"><div class="card-body p-4">
<h1 class="h4 mb-3">Profil Pengguna</h1>
<dl class="row mb-4"><dt class="col-sm-4">Nama</dt><dd class="col-sm-8"><?= e($_SESSION['nama']) ?></dd>
<dt class="col-sm-4">Username</dt><dd class="col-sm-8"><?= e($_SESSION['username']) ?></dd>
<dt class="col-sm-4">Role</dt><dd class="col-sm-8 text-capitalize"><?= e($_SESSION['role']) ?></dd></dl>
<div class="d-flex gap-2"><a class="btn btn-primary" href="edit_profil.php">Ubah Nama</a><a class="btn btn-outline-secondary" href="ubah_password.php">Ubah Password</a></div>
</div></div></div></div>
<?php page_footer(); ?>
