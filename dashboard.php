<?php
require_once 'functions.php';
require_login();
$role = $_SESSION['role'] ?? '';
$target = ['admin'=>'admin.php','petugas'=>'petugas.php','siswa'=>'siswa.php'][$role] ?? null;
if (!$target) { $_SESSION = []; session_destroy(); redirect('index.php'); }
redirect($target);
