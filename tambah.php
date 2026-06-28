<?php
// Menyertakan file koneksi (Syarat UAS: include atau require)
include 'koneksi.php';

// Syarat UAS: Menggunakan Percabangan (if) untuk memproses data form POST
if (isset($_POST['submit'])) {
    // Mengambil data dari form (Syarat UAS: Form Processing)
    $judul     = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $status    = $_POST['status'];

    // Query untuk memasukkan data ke tabel tugas
    $input = mysqli_query($koneksi, "INSERT INTO tugas (judul_tugas, deskripsi, status) VALUES ('$judul', '$deskripsi', '$status')");
    
    // Jika berhasil, langsung dialihkan kembali ke halaman utama
    if ($input) {
        header("Location: index.php");
    } else {
        echo "Gagal menambahkan data baru.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Tugas Baru</h2>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>Judul Tugas</label><br>
                <input type="text" name="judul_tugas" required placeholder="Masukkan judul tugas...">
            </div>
            <br>
            <div class="form-group">
                <label>Deskripsi Tugas</label><br>
                <textarea name="deskripsi" required placeholder="Masukkan deskripsi detail tugas..."></textarea>
            </div>
            <br>
            <div class="form-group">
                <label>Status</label><br>
                <select name="status">
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <br>
            <button type="submit" name="submit" class="btn-simpan">Simpan Tugas</button>
            <a href="index.php" class="btn-kembali">Kembali</a>
        </form>
    </div>
</body>
</html>
