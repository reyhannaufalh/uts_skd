<?php
(@include('../app/koneksi.php')) or die('Tidak bisa terkoneksi ke database'); //require()
if ($_POST) {
    $db = new database();
    $db->__construct();
    if ($db->insert($_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['username'],  $_POST['email'], md5($_POST['password']), hash('sha1', $_POST['password']), hash('sha256', $_POST['password']))) {
        //otomatis login
        session_start();
        $result = $db->verifyAccount($_POST['username'], $_POST['password']); //verifikasi password

        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['password'] = $result['password'];
        header("location:../app/result.php");
        //-----------------------------
    } else {
        echo "<script>alert('Gagal membuat akun')</script>";
        header("location:registrasi.php");
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
    <div class="container">
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
                <h4 id="main-header">Sign Up</h4>

                <form action="" method="POST" class="signup">
                    <div class="name">
                        <div>
                            <label for="firstname">Nama depan</label>
                            <input type="text" placeholder="Nama depan" name="firstname" id="firstname" required
                                autofocus>
                        </div>
                        <div>
                            <label for="lastname">Nama belakang</label>
                            <input type="text" placeholder="Nama belakang" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    <label for="username">Username</label>
                    <input type="text" placeholder="username" name="username" id="username" required>
                    <label for="alamat">Alamat</label>
                    <input type="text" placeholder="Alamat" name="address" id="alamat" required>
                    <label for="email">E-mail</label>
                    <input type="email" placeholder="E-mail" name="email" id="email" required>
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" placeholder="Konfirmasi Password" name="password2" id="password2" required>
                    <button type="submit" name="register" id="signup" class="btn-main">Sign Up</button>
                </form>
                <div class="register">
                    <p id="signin-text">Sudah punya akun?</p>
                    <a href="login.php" id="link">Masuk Sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>