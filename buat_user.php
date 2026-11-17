<?php
require_once 'config.php';
$users = [
 ['Administrator','admin','admin123','admin'],
 ['Petugas Sekolah','petugas','petugas123','petugas'],
 ['Siswa SMK','siswa','siswa123','siswa'],
];
$sql = 'INSERT INTO users (nama,username,password,role) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE nama=VALUES(nama), password=VALUES(password), role=VALUES(role)';
$stmt = $koneksi->prepare($sql);
foreach ($users as $u) $stmt->execute([$u[0],$u[1],password_hash($u[2], PASSWORD_DEFAULT),$u[3]]);
echo 'Akun contoh berhasil dibuat. Demi keamanan, hapus file buat_user.php sekarang.';
