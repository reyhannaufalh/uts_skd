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
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body class="main-page">
    <div class="main-container">
        <nav>
            <h1 id="nav-title">Kelompok 5 <span id="SKD">SKD</span></h1>
            <a href="view/login.php" id="btn-login">Login</a>
        </nav>
        <main class="landing-page">
            <div class="main main-1">
                <div class="main-header">
                    <p id="main-title">Text</p>
                    <h2>Plain Text</h2>
                </div>
                <div class="main-input">
                    <textarea name="" id="plain" cols="30"
                        rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</textarea>
                </div>
            </div>
            <div class="main main-2">
                <div class="switch-mode">
                    <div class="mode active">
                        <label for="en">Enkripsi</label>
                        <input type="radio" id="en" name="mode" checked>
                    </div>
                    <div class="mode">
                        <label for="de">Dekripsi</label>
                        <input type="radio" id="de" name="mode">
                    </div>
                </div>

                <select name="" id="">
                    <option value="caesar">Caesar Cipher</option>
                    <option value="vignere">Vignere Cipher</option>
                    <option value="aes">AES</option>
                    <option value="rsa">RSA</option>
                    <option value="rc4">RC4</option>
                </select>

                <div class="key">
                    <p>Key</p>
                    <input type="text" name="key">
                </div>

                <button class="btn-main" name="submit">Submit</button>
            </div>
            <div class="main main-3">
                <div class="main-header">
                    <p>Text</p>
                    <h2>Cipher Text</h2>
                </div>
                <div class="main-input">
                    <textarea name="" id="cipher" cols="30"
                        rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</textarea>
                </div>
            </div>
        </main>
    </div>
    <script src="public/js/script.js"></script>
</body>

</html>