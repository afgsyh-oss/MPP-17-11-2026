<?php
require_once 'functions.php'; require_once 'config.php'; require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 verify_csrf(); $nama = trim($_POST['nama'] ?? '');
 if ($nama === '' || mb_strlen($nama) > 100) flash('error','Nama wajib diisi (maksimal 100 karakter).');
 else {
  $stmt=$koneksi->prepare('UPDATE users SET nama=? WHERE id=?'); $stmt->execute([$nama,$_SESSION['user_id']]);
  $_SESSION['nama']=$nama; flash('success','Nama profil berhasil diperbarui.'); redirect('profil.php');
 }
}
page_header('Ubah Nama');
?>
<div class="row justify-content-center"><div class="col-md-6"><div class="card border-0 shadow-sm"><div class="card-body p-4">
<h1 class="h4">Ubah Nama Pengguna</h1><form method="post">
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<label class="form-label">Nama lengkap</label><input class="form-control mb-3" name="nama" maxlength="100" value="<?= e($_SESSION['nama']) ?>" required>
<button class="btn btn-primary">Simpan Perubahan</button> <a class="btn btn-light" href="profil.php">Batal</a>
</form></div></div></div></div>
<?php page_footer(); ?>
