<?php 

session_start();

if (!isset($_SESSION['login']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


include 'koneksi.php'; 

// Mengambil data dari tabel tugas
$query = mysqli_query($koneksi, "SELECT * FROM tugas");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List UAS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header-banner">
        <h1>Aplikasi To-Do List Sederhana</h1>
        <p>Sistem Catatan Tugas Berbasis PHP Native & MySQL</p>
    </div>

    <div class="nav-menu" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <a href="index.php">Home</a>
            <a href="tambah.php">Tambah Tugas</a>
        </div>
        <a href="logout.php" style="color: #fca5a5; margin-right: 0;" onclick="return confirm('Yakin ingin keluar?')">Logout (<?php echo $_SESSION['username']; ?>)</a>
    </div>

    <div class="container">
        <h2>Selamat Datang</h2>
        <div class="total-info">
            <p>Website ini dibuat untuk membantu mengelola list tugas kuliah secara mudah.</p>
            <strong>Total Tugas Saat Ini: <?php echo hitungTotalTugas($koneksi); ?> tugas</strong>
        </div>
        
        <a href="tambah.php" class="btn-tambah">+ Tambah Tugas Baru</a>
        
        <table cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Tugas</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Perulangan (while) untuk menampilkan data tugas
                while($data = mysqli_fetch_assoc($query)) { 
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($data['judul_tugas']); ?></td>
                    <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
                    <td>
                        <span class="badge <?php echo stylingStatus($data['status']); ?>">
                            <?php echo $data['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn-edit">Edit</a> | 
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
