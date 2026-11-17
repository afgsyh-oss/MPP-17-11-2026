<?php
require_once 'functions.php'; require_once 'config.php'; require_role('admin');
$users=$koneksi->query('SELECT id,nama,username,role,created_at FROM users ORDER BY id DESC')->fetchAll();
page_header('Kelola Pengguna');
?>
<div class="d-flex justify-content-between align-items-center mb-3"><div><h1 class="h4 mb-1">Manajemen Pengguna</h1><p class="text-secondary mb-0">Halaman ini hanya dapat diakses Admin.</p></div></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0">
<thead class="table-light"><tr><th>ID</th><th>Nama</th><th>Username</th><th>Role</th><th>Dibuat</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($users as $u): ?><tr><td><?= (int)$u['id'] ?></td><td><?= e($u['nama']) ?></td><td><?= e($u['username']) ?></td><td><span class="badge text-bg-secondary"><?= e($u['role']) ?></span></td><td><?= e($u['created_at']) ?></td><td class="text-nowrap">
<a class="btn btn-sm btn-outline-primary" href="user_edit.php?id=<?= (int)$u['id'] ?>">Edit</a>
<?php if ((int)$u['id'] !== (int)$_SESSION['user_id']): ?><form class="d-inline" method="post" action="user_hapus.php" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="btn btn-sm btn-outline-danger">Hapus</button></form><?php endif; ?>
</td></tr><?php endforeach; ?>
<?php if (!$users): ?><tr><td colspan="6" class="text-center text-secondary py-4">Belum ada pengguna.</td></tr><?php endif; ?>
</tbody></table></div></div>
<?php page_footer(); ?>
