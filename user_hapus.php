<?php
require_once 'functions.php'; require_once 'config.php'; require_role('admin');
if ($_SERVER['REQUEST_METHOD']!=='POST') redirect('kelola_user.php');
verify_csrf(); $id=(int)($_POST['id']??0);
if ($id===(int)$_SESSION['user_id']) flash('error','Admin tidak dapat menghapus akunnya sendiri.');
else { $stmt=$koneksi->prepare('DELETE FROM users WHERE id=?'); $stmt->execute([$id]); flash('success','Pengguna berhasil dihapus.'); }
redirect('kelola_user.php');
