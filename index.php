<?php
(@include('app/koneksi.php')) or die('Tidak bisa terkoneksi ke database');
require 'app/Conversion.php';
session_start();

if (isset($_GET['hash'])) {
    $tipe = $_GET['hash'];
} else if (isset($_POST['hash'])) {
    $tipe = $_POST['hash'];
} else {
    $tipe = 'CC';
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
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body class="main-page">
    <div class="main-container">
        <nav>
            <h1 id="nav-title">Kelompok 5 <span id="SKD">SKD</span></h1>
            <?php if (!isset($_SESSION['firstname'])) { ?>
            <a href="view/login.php" id="btn-login">Login</a>
            <?php } else { ?>
            <a href="app/logout.php" id="btn-logout">Logout</a>
            <?php } ?>
        </nav>
        <main class="landing-page">
            <div class="main main-2">
                <form action="" method="get">
                    <select name="hash" id="hash" class="select-tipe">
                        <option value="CC" <?= ($tipe == 'CC') ? 'selected' : ''; ?>>Caesar Chiper</option>
                        <option value="VC" <?= ($tipe == 'VC') ? 'selected' : ''; ?>>VigenereChiper</option>
                        <option value="AES-128-CBC" <?= ($tipe == 'AES-128-CBC') ? 'selected' : ''; ?>>AES-128-CBC
                        </option>
                        <option value="AES-256-CBC" <?= ($tipe == 'AES-256-CBC') ? 'selected' : ''; ?>>AES-256-CBC
                        </option>
                        <option value="AES-128-CTR" <?= ($tipe == 'AES-128-CTR') ? 'selected' : ''; ?>>AES-128-CTR
                        </option>
                        <option value="AES-256-CTR" <?= ($tipe == 'AES-256-CTR') ? 'selected' : ''; ?>>AES-256-CTR
                        </option>
                        <option value="RSA" <?= ($tipe == 'RSA') ? 'selected' : ''; ?>>RSA</option>
                        <option value="RC4" <?= ($tipe == 'RC4') ? 'selected' : ''; ?>>RC4</option>
                    </select>
                </form>

                <div class="key">
                    <form action="" method="post">
                        <input type="hidden" name="hash" value="<?= $tipe ?>">
                        <table>
                            <tbody>
                                <?php
                                switch ($tipe) {
                                    case 'CC':
                                        $hash = (isset($_POST['hash']))? $_POST['key']: '';
                                        ?>
                                        <tr>
                                            <td>Key</td>
                                            <td>
                                                <input type="number" name="key" value="<?=$hash?>">
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'VC':
                                        $hash = (isset($_POST['hash']))? $_POST['key']: '';
                                        ?>
                                        <tr>
                                            <td>Key</td>
                                            <td>
                                                <input type="text" name="key" value="<?=$hash?>">
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'AES-128-CBC':
                                        $aes = new AES();
                                        $aes->Chiper('aes-128-cbc');
                                        ?>
                                        <tr>
                                            <td id="td-title">Key</td>
                                            <td>
                                                <textarea name="key" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['key']:$aes->getKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Iv</td>
                                            <td>
                                                <textarea name="iv" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['iv']:$aes->getIv(); ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'AES-256-CBC':
                                        $aes = new AES();
                                        $aes->Chiper('aes-256-cbc');
                                        ?>
                                        <tr>
                                            <td id="td-title">Key</td>
                                            <td>
                                                <textarea name="key" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['key']:$aes->getKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Iv</td>
                                            <td>
                                                <textarea name="iv" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['iv']:$aes->getIv(); ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'AES-128-CTR':
                                        $aes = new AES();
                                        $aes->Chiper('aes-128-ctr');
                                        ?>
                                        <tr>
                                            <td id="td-title">Key</td>
                                            <td>
                                                <textarea name="key" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['key']:$aes->getKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Iv</td>
                                            <td>
                                                <textarea name="iv" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['iv']:$aes->getIv(); ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'AES-256-CTR':
                                        $aes = new AES();
                                        $aes->Chiper('aes-256-ctr');
                                        ?>
                                        <tr>
                                            <td id="td-title">Key</td>
                                            <td>
                                                <textarea name="key" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['key']:$aes->getKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Iv</td>
                                            <td>
                                                <textarea name="iv" rows="4" cols="50"><?= (isset($_POST['hash']))?$_POST['iv']:$aes->getIv(); ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'RSA':
                                        $rsa = new RSA();
                                        $rsa->generateKey();
                                        ?>
                                        <tr>
                                            <td id="td-title">Public key</td>
                                            <td>
                                                <textarea name="public_key" rows="4"
                                                    cols="50"><?= (isset($_POST['hash']))?$_POST['public_key']:$rsa->getPublicKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Private key</td>
                                            <td>
                                                <textarea name="private_key" rows="4"
                                                    cols="50"><?= (isset($_POST['hash']))?$_POST['private_key']: $rsa->getPrivateKey(); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="td-title">Key yang digunakan</td>
                                            <td>
                                                <select name="selected_key" id="select-key">
                                                    <option value="public">Public key</option>
                                                    <option value="private">Private key</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                    case 'RC4':
                                        $key = (isset($_POST['hash']))? $_POST['key']: '';
                                        ?>
                                        <tr>
                                            <td>Key</td>
                                            <td>
                                                <input type="text" name="key" value="<?=$key?>">
                                            </td>
                                        </tr>
                                        <?php
                                    break;
                                }
                                ?>
                            </tbody>
                        </table>
                </div>
                <div class="switch-mode">
                    <div class="mode active">
                        <label for="en">Enkripsi</label>
                        <input type="radio" id="en" name="tipe" value="enkripsi" checked>
                    </div>
                    <div class="mode">
                        <label for="de">Dekripsi</label>
                        <input type="radio" id="de" name="tipe" value="dekripsi">
                    </div>
                </div>
                <button class="btn-main" name="submit">Konversi</button>

            </div>
            <div class="main main-1">
                <div class="main-header">
                    <h2>Input Text</h2>
                </div>
                <div class="main-body">
                    <textarea name="input" id="plain" cols="30"
                        rows="10"><?= (isset($_POST['hash']))? $_POST['input'] : "Lorem ipsum dolor sit amet, consectetur adipisicing elit."?></textarea>
                </div>
                </form>
            </div>

            <div class="main main-3">
                <div class="main-header">
                    <h2>Output Text</h2>
                </div>
                <div class="main-body">
                    <?php
                    if (isset($_POST['hash'])) {
                        switch ($_POST['hash']) {
                            case 'CC':
                                $cc = new CaesarChiper();
                                $cc->setInput($_POST['input']);
                                $cc->setKey($_POST['key']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $cc->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $cc->Dekrip();
                                        break;
                                }
                                break;
                            case 'VC':
                                $vc = new VigenereChiper();
                                $vc->setInput($_POST['input']);
                                $vc->setKey($_POST['key']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $vc->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $vc->Dekrip();
                                        break;
                                }
                                break;
                            case 'AES-128-CBC':
                                $aes = new AES();
                                $aes->setInput($_POST['input']);
                                $aes->Chiper($_POST['hash']);
                                $aes->setKey($_POST['key']);
                                $aes->setIv($_POST['iv']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $aes->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $aes->Dekrip();
                                        break;
                                }
                                break;
                            case 'AES-256-CBC':
                                $aes = new AES();
                                $aes->setInput($_POST['input']);
                                $aes->Chiper($_POST['hash']);
                                $aes->setKey($_POST['key']);
                                $aes->setIv($_POST['iv']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $aes->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $aes->Dekrip();
                                        break;
                                }
                                break;
                            case 'AES-128-CTR':
                                $aes = new AES();
                                $aes->setInput($_POST['input']);
                                $aes->Chiper($_POST['hash']);
                                $aes->setKey($_POST['key']);
                                $aes->setIv($_POST['iv']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $aes->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $aes->Dekrip();
                                        break;
                                }
                                break;
                            case 'AES-256-CTR':
                                $aes = new AES();
                                $aes->setInput($_POST['input']);
                                $aes->Chiper($_POST['hash']);
                                $aes->setKey($_POST['key']);
                                $aes->setIv($_POST['iv']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $aes->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $aes->Dekrip();
                                        break;
                                }
                                break;
                            case 'RSA':
                                $rsa = new RSA();
                                $rsa->setInput($_POST['input']);
                                $rsa->setPublicKey($_POST['public_key']);
                                $rsa->setPrivateKey($_POST['private_key']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $rsa->Enkrip($_POST['selected_key']);
                                        break;
                                    case 'dekripsi':
                                        $output = $rsa->Dekrip($_POST['selected_key']);
                                        break;
                                }
                                break;
                            case 'RC4':
                                $cc = new RC4();
                                $cc->setInput($_POST['input']);
                                $cc->setKey($_POST['key']);
                                switch ($_POST['tipe']) {
                                    case 'enkripsi':
                                        $output = $cc->Enkrip();
                                        break;
                                    case 'dekripsi':
                                        $output = $cc->Dekrip();
                                        break;
                                }
                                break;
                        }
                    } else {
                        $output ="";
                    }
                    ?>
                    <textarea id="plain" cols="30"
                        rows="10"><?= $output ?></textarea>
                </div>
            </div>
        </main>
    </div>
    <script src="public/js/script.js"></script>
</body>

</html>
