<?php
// Kompatibilitas dengan materi jobsheet: fungsi cekLogin() dan cekRole().
require_once 'functions.php';
function cekLogin(): void { require_login(); }
function cekRole(string $role): void { require_role($role); }
