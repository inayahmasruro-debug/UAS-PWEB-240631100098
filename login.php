<?php
// Memulai session PHP
session_start();
include 'koneksi.php';

// Jika user sudah login sebelumnya, langsung lempar ke halaman utama
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Proses ketika tombol login diklik
if (isset($_POST['submit_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mencari user di database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        
        // Validasi password sederhana
        if ($password === $row['password']) {
            // Set session login berhasil
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UAS To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Mengatur posisi box login agar presisi di tengah halaman polosan */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f7f6;
            padding: 20px;
        }
        .login-box {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            border-top: 5px solid #14b8a6; /* Garis aksen teal di atas box */
        }
        .error-msg {
            color: #ef4444;
            background-color: #fef2f2;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 18px;
            text-align: center;
            border: 1px solid #fee2e2;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container login-box">
        <h2 style="text-align: center; margin-bottom: 8px; color: #0f766e;">Selamat Datang</h2>
        <p style="text-align: center; margin-bottom: 25px; color: #64748b;">Silakan masuk untuk mengakses sistem To-Do List.</p>

        <?php if (isset($error)) : ?>
            <div class="error-msg">Username atau Password salah!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda..." required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;" placeholder="Masukkan password Anda..." required>
            </div>
            
            <br>
            <button type="submit" name="submit_login" class="btn-simpan" style="width: 100%; padding: 12px;">Masuk Ke Sistem</button>
        </form>
    </div>

</body>
</html>
