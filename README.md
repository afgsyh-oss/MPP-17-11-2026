# Sistem Login dan Hak Akses — PHP Native

Aplikasi praktik berdasarkan jobsheet **Implementasi Login dan Hak Akses Menggunakan PHP, MySQL, dan Bootstrap**.

## Teknologi
- PHP Native (PDO)
- MySQL / MariaDB
- Bootstrap 5.3
- Session dan password hashing

## Instalasi di XAMPP
1. Jalankan Apache dan MySQL dari XAMPP Control Panel.
2. Salin folder `login_hakakses` ke `C:\xampp\htdocs\` (atau folder `htdocs` XAMPP yang kamu gunakan).
3. Buka `http://localhost/phpmyadmin`.
4. Pilih tab **Import**, lalu impor file `database.sql`.
5. Jika username/password MySQL berbeda, sesuaikan `$user` dan `$pass` pada `config.php`.
6. Buka `http://localhost/login_hakakses/buat_user.php` satu kali untuk membuat tiga akun contoh.
7. Setelah berhasil, **hapus `buat_user.php`** dari folder project.
8. Buka `http://localhost/login_hakakses/`.

## Akun praktik
| Role | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |
| Petugas | `petugas` | `petugas123` |
| Siswa | `siswa` | `siswa123` |

Password disimpan menggunakan `password_hash()`, bukan teks biasa.

## Fitur
- Login dan logout
- Dashboard berbeda sesuai role
- Proteksi halaman di sisi server (HTTP 403 jika role tidak sesuai)
- Profil pengguna
- Ubah nama dan password sendiri
- Admin: daftar, tambah akun melalui seed awal, edit role/data, dan hapus pengguna
- Prepared statement, escaping output, regenerasi session ID, dan token CSRF pada form yang mengubah data

## Pengujian hak akses
| Login sebagai | Halaman yang dicoba | Hasil |
|---|---|---|
| Admin | `admin.php` | Diizinkan |
| Admin | `petugas.php`, `siswa.php` | Ditolak |
| Petugas | `petugas.php` | Diizinkan |
| Petugas | `admin.php`, `siswa.php`, `kelola_user.php` | Ditolak |
| Siswa | `siswa.php` | Diizinkan |
| Siswa | `admin.php`, `petugas.php`, `kelola_user.php` | Ditolak |
| Belum login | dashboard mana pun | Dialihkan ke login |

## Struktur utama
- `config.php` — koneksi PDO
- `functions.php` — session, CSRF, helper, layout Bootstrap
- `index.php` — form login
- `proses_login.php` — autentikasi
- `dashboard.php` — pengarah dashboard
- `admin.php`, `petugas.php`, `siswa.php` — dashboard tiap role
- `profil.php`, `edit_profil.php`, `ubah_password.php` — profil pengguna
- `kelola_user.php`, `user_edit.php`, `user_hapus.php` — manajemen pengguna khusus admin
- `logout.php` — mengakhiri session
- `database.sql` — struktur database

## Catatan
- Ini project latihan lokal. Untuk deployment publik, gunakan HTTPS, batasi percobaan login, atur cookie session secara aman, dan lakukan backup database.
- Pastikan file `buat_user.php` sudah dihapus setelah seed akun.
