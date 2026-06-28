<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Mengambil ID data yang akan diedit dari URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Mengambil data tugas yang sesuai dengan ID
$query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan, balikkan ke halaman utama
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}

// Proses ketika tombol simpan/update diklik
if (isset($_POST['update'])) {
    $judul_tugas = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];

    // Query untuk memperbarui data di database
    $result = mysqli_query($koneksi, "UPDATE tugas SET judul_tugas='$judul_tugas', deskripsi='$deskripsi', status='$status' WHERE id='$id'");

    if ($result) {
        // Jika berhasil, langsung dialihkan kembali ke index.php
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas - UAS To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header-banner">
        <h1>Ubah Catatan Tugas</h1>
        <p>Silakan sesuaikan kembali detail tugas kuliahmu di bawah ini.</p>
    </div>

    <div class="nav-menu">
        <a href="index.php">Home</a>
        <a href="tambah.php">Tambah Tugas</a>
    </div>

    <div class="container">
        <h2>Form Edit Tugas</h2>
        <div class="total-info">
            <p>Pastikan semua kolom form terisi dengan benar sebelum disimpan.</p>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label for="judul_tugas">Judul Tugas</label>
                <input type="text" id="judul_tugas" name="judul_tugas" value="<?php echo htmlspecialchars($data['judul_tugas']); ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Tugas</label>
                <textarea id="deskripsi" name="deskripsi" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status Tugas</label>
                <select id="status" name="status">
                    <option value="Belum Selesai" <?php if($data['status'] == 'Belum Selesai') echo 'selected'; ?>>Belum Selesai</option>
                    <option value="Proses" <?php if($data['status'] == 'Proses') echo 'selected'; ?>>Proses</option>
                    <option value="Selesai" <?php if($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn-simpan">Simpan Perubahan</button>
            <a href="index.php" class="btn-kembali">Batal</a>
        </form>
    </div>

</body>
</html>
