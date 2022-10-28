<?php
(@include('../app/koneksi.php')) or die('Tidak bisa terkoneksi ke database'); //require()
if ($_POST) {
    $db = new database();
    $db->__construct();

    session_start();
    $result = $db->verifyAccount($_POST['username'], $_POST['password']); //verifikasi password
    if ($result != null) {
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['password'] = $result['password'];
        header("location:../index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok 5 SKD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="full">
    <div class="container sign-in-page">
        <div class="left">
            <div class="left-content">
                <img src="../public/img/logo_uns.png" alt="">
                <h2>Ujian Tengah Semester<br> Program Enkripsi dan Dekripsi<br> Sistem Keamanan Data</h2>
                <ol>
                    <li>Ramsya Devanaqia V A</li>
                    <li>Reyhan Naufal Hakim</li>
                    <li>Syifa’ Auliya Ash-Sholihah</li>
                    <li>Tegar Aditya</li>
                    <li>Fauzi Ardiantama</li>
                </ol>
            </div>
        </div>
        <div class="right">
            <div class="right-content">
                <h4 id="main-header">Sign In</h4>

                <form action="" method="POST">
                    <div class="signin">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Username" name="username" id="username signin-input" required>
                        <label for="password">Password</label>
                        <input type="password" placeholder="Password" name="password" id="password signin-input"
                            required>
                        <button type="submit" name="register" id="signin" class="btn-main">Sign In</button>
                    </div>
                </form>
                <div class="register">
                    <p id="signin-text">Belum punya akun?</p>
                    <a href="registrasi.php" id="link">Daftar Sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>