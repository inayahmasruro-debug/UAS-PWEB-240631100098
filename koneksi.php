<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_todolist";

// Mengkoneksikan PHP ke database MySQL
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}


// Fungsi 1: Menghitung total semua tugas yang ada di database
function hitungTotalTugas($koneksi) {
    $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tugas");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}

// Fungsi 2: Mengubah warna tampilan status tugas berdasarkan nilainya
function stylingStatus($status) {
    if ($status == "Selesai") {
        return "status-selesai";
    } elseif ($status == "Proses") {
        return "status-proses";
    } else {
        return "status-belum";
    }
}
?>
