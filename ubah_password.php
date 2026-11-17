<?php
require_once 'functions.php'; require_once 'config.php'; require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 verify_csrf(); $lama=$_POST['password_lama'] ?? ''; $baru=$_POST['password_baru'] ?? ''; $konfirmasi=$_POST['konfirmasi'] ?? '';
 $stmt=$koneksi->prepare('SELECT password FROM users WHERE id=?'); $stmt->execute([$_SESSION['user_id']]); $hash=$stmt->fetchColumn();
 if (!$hash || !password_verify($lama,$hash)) flash('error','Password lama tidak sesuai.');
 elseif (strlen($baru)<8) flash('error','Password baru minimal 8 karakter.');
 elseif ($baru!==$konfirmasi) flash('error','Konfirmasi password tidak sama.');
 else { $stmt=$koneksi->prepare('UPDATE users SET password=? WHERE id=?'); $stmt->execute([password_hash($baru,PASSWORD_DEFAULT),$_SESSION['user_id']]); session_regenerate_id(true); flash('success','Password berhasil diubah.'); redirect('profil.php'); }
}
page_header('Ubah Password');
?>
<div class="row justify-content-center"><div class="col-md-6"><div class="card border-0 shadow-sm"><div class="card-body p-4">
<h1 class="h4">Ubah Password</h1><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label class="form-label">Password lama</label><input class="form-control" type="password" name="password_lama" required></div>
<div class="mb-3"><label class="form-label">Password baru</label><input class="form-control" type="password" name="password_baru" minlength="8" required></div>
<div class="mb-3"><label class="form-label">Konfirmasi password baru</label><input class="form-control" type="password" name="konfirmasi" minlength="8" required></div>
<button class="btn btn-primary">Simpan Password</button> <a class="btn btn-light" href="profil.php">Batal</a></form>
</div></div></div></div>
<?php page_footer(); ?>
