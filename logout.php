<?php
// Memulai session agar bisa dihapus
session_start();

// Menghapus semua data session login
session_unset();
session_destroy();

// Mengalihkan langsung kembali ke halaman login
header("Location: login.php");
exit;
?>
