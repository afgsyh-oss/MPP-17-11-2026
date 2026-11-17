<?php
require_once 'functions.php'; require_once 'config.php'; require_role('admin');
$id=(int)($_GET['id'] ?? 0); $stmt=$koneksi->prepare('SELECT id,nama,username,role FROM users WHERE id=?'); $stmt->execute([$id]); $u=$stmt->fetch();
if (!$u) { http_response_code(404); exit('Pengguna tidak ditemukan.'); }
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $nama=trim($_POST['nama']??''); $username=trim($_POST['username']??''); $role=$_POST['role']??'';
 if ($nama==='' || $username==='' || !in_array($role,['admin','petugas','siswa'],true)) flash('error','Periksa kembali data pengguna.');
 else {
  try { $stmt=$koneksi->prepare('UPDATE users SET nama=?,username=?,role=? WHERE id=?'); $stmt->execute([$nama,$username,$role,$id]); if ($id===(int)$_SESSION['user_id']) { $_SESSION['nama']=$nama; $_SESSION['username']=$username; $_SESSION['role']=$role; } flash('success','Data pengguna berhasil diperbarui.'); redirect('kelola_user.php'); }
  catch(PDOException $e) { flash('error','Username sudah digunakan pengguna lain.'); }
 }
}
page_header('Edit Pengguna');
?>
<div class="row justify-content-center"><div class="col-md-6"><div class="card border-0 shadow-sm"><div class="card-body p-4"><h1 class="h4">Edit Pengguna</h1>
<form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="nama" value="<?= e($u['nama']) ?>" required></div>
<div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" value="<?= e($u['username']) ?>" required></div>
<div class="mb-3"><label class="form-label">Role</label><select class="form-select" name="role"><?php foreach(['admin','petugas','siswa'] as $r): ?><option value="<?= $r ?>" <?= $u['role']===$r?'selected':'' ?>><?= ucfirst($r) ?></option><?php endforeach; ?></select></div>
<button class="btn btn-primary">Simpan</button> <a class="btn btn-light" href="kelola_user.php">Kembali</a></form>
</div></div></div></div>
<?php page_footer(); ?>
