<?php
// Menyertakan file koneksi (Syarat UAS: include atau require)
include 'koneksi.php';

// Mengambil ID data yang mau dihapus dari URL (Form Processing GET)
$id = $_GET['id'];

// Query SQL untuk menghapus data tugas berdasarkan ID-nya
$hapus = mysqli_query($koneksi, "DELETE FROM tugas WHERE id=$id");

// Jika proses hapus berhasil, langsung dialihkan kembali ke halaman utama
if ($hapus) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data tugas.";
}
?>
