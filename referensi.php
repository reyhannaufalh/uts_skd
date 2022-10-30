<!DOCTYPE html>
<?php
require 'app/conversion.php';
if (isset($_GET['hash']))
{
    $tipe = $_GET['hash'];
} else if (isset($_POST['hash']))
{
    $tipe = $_POST['hash'];
} else
{
    $tipe = 'CC';
}
?>
<html>
    <head>
        <title>Enkripsi-Dekripsi</title>
    </head>
    <body>
        <h1>SKD-UTS</h1>
        <form action="" method="get">
            <select name="hash">
                <option value="CC" <?= ($tipe=='CC')?'selected':'';?>>Caesar Chiper</option>
                <option value="VC" <?= ($tipe=='VC')?'selected':'';?>>VigenereChiper</option>
                <option value="AES-128-CBC" <?= ($tipe=='AES-128-CBC')?'selected':'';?>>AES-128-CBC</option>
                <option value="AES-256-CBC" <?= ($tipe=='AES-256-CBC')?'selected':'';?>>AES-256-CBC</option>
                <option value="AES-128-CTR" <?= ($tipe=='AES-128-CTR')?'selected':'';?>>AES-128-CTR</option>
                <option value="AES-256-CTR" <?= ($tipe=='AES-256-CTR')?'selected':'';?>>AES-256-CTR</option>
                <option value="RSA" <?= ($tipe=='RSA')?'selected':'';?>>RSA</option>
                <option value="RC4" <?= ($tipe=='RC4')?'selected':'';?>>RC4</option>
            </select>
            <button type="submit">Pilih</button>
        </form>
        <form action="" method="post">
            <input type="hidden" name="hash" value="<?= $tipe ?>">
            <table>
                <tbody>
                    <tr>
                        <td>Input</td>
                        <td>
                            <textarea name="input" rows="4" cols="50"></textarea>
                        </td>
                    </tr>
                    <?php
                    switch($tipe)
                    {
                        case 'CC':
                        ?>
                        <tr>
                            <td>Key</td>
                            <td>
                                <input type="number" name="key">
                            </td>
                        </tr>
                        <?php
                        break;
                        case 'VC':
                        ?>
                        <tr>
                        <td>Key</td>
                            <td>
                                <input type="text" name="key">
                            </td>
                        </tr>
                        <?php
                        break;
                        case 'AES-128-CBC':
                        $aes = new AES();
                        $aes->Chiper('aes-128-cbc');
                            ?>
                            <tr>
                                <td>Key</td>
                                <td>
                                    <textarea name="key" rows="4" cols="50"><?= $aes->getKey();?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Iv</td>
                                <td>
                                    <textarea name="iv" rows="4" cols="50"><?= $aes->getIv();?></textarea>
                                </td>
                            </tr>
                            <?php
                        break;
                        case 'AES-256-CBC':
                            $aes = new AES();
                            $aes->Chiper('aes-256-cbc');
                            ?>
                            <tr>
                                <td>Key</td>
                                <td>
                                    <textarea name="key" rows="4" cols="50"><?= $aes->getKey();?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Iv</td>
                                <td>
                                    <textarea name="iv" rows="4" cols="50"><?= $aes->getIv();?></textarea>
                                </td>
                            </tr>
                            <?php
                        break;
                        case 'AES-128-CTR':
                            $aes = new AES();
                            $aes->Chiper('aes-128-ctr');
                            ?>
                            <tr>
                                <td>Key</td>
                                <td>
                                    <textarea name="key" rows="4" cols="50"><?= $aes->getKey();?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Iv</td>
                                <td>
                                    <textarea name="iv" rows="4" cols="50"><?= $aes->getIv();?></textarea>
                                </td>
                            </tr>
                            <?php
                        break;
                        case 'AES-256-CTR':
                            $aes = new AES();
                            $aes->Chiper('aes-256-ctr');
                            ?>
                            <tr>
                                <td>Key</td>
                                <td>
                                    <textarea name="key" rows="4" cols="50"><?= $aes->getKey();?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Iv</td>
                                <td>
                                    <textarea name="iv" rows="4" cols="50"><?= $aes->getIv();?></textarea>
                                </td>
                            </tr>
                            <?php
                        break;
                        case 'RSA':
                            $rsa = new RSA();
                            $rsa->generateKey();
                        ?>
                        <tr>
                            <td>Public key</td>
                            <td>
                                <textarea name="public_key" rows="4" cols="50"><?= $rsa->getPublicKey();?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Private key</td>
                            <td>
                                <textarea name="private_key" rows="4" cols="50"><?= $rsa->getPrivateKey();?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Key yg digunakan</td>
                            <td>
                                <select name="selected_key">
                                    <option value="public">Public key</option>
                                    <option value="private">Private key</option>
                                </select>
                            </td>
                        </tr>
                        <?php
                        break;
                        case 'RC4':
                        ?>
                        <tr>
                        <td>Key</td>
                            <td>
                                <input type="text" name="key">
                            </td>
                        </tr>
                        <?php
                        break;
                    }
                    ?>
                    <tr>
                        <td>Tipe</td>
                        <td>
                            <select name="tipe">
                                <option value="enkripsi">Enkripsi</option>
                                <option value="dekripsi">Dekripsi</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit">Konversi</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div>
            <?php
            if (isset($_POST['hash']))
            {
                switch($_POST['hash'])
                {
                    case 'CC':
                    $cc = new CaesarChiper();
                    $cc->setInput($_POST['input']);
                    $cc->setKey($_POST['key']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $cc->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $cc->Dekrip();
                        break;
                    }
                    break;
                    case 'VC':
                    $vc = new VigenereChiper();
                    $vc->setInput($_POST['input']);
                    $vc->setKey($_POST['key']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $vc->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $vc->Dekrip();
                        break;
                    }
                    break;
                    case 'AES-128-CBC':
                    $aes1 = new AES();
                    $aes1->setInput($_POST['input']);
                    $aes1->Chiper($_POST['hash']);
                    $aes1->setKey($_POST['key']);
                    $aes1->setIv($_POST['iv']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $aes1->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $aes1->Dekrip();
                        break;
                    }
                    break;
                    case 'AES-256-CBC':
                    $aes1 = new AES();
                    $aes1->setInput($_POST['input']);
                    $aes1->Chiper($_POST['hash']);
                    $aes1->setKey($_POST['key']);
                    $aes1->setIv($_POST['iv']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $aes1->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $aes1->Dekrip();
                        break;
                    }   
                    break;
                    case 'AES-128-CTR':
                    $aes1 = new AES();
                    $aes1->setInput($_POST['input']);
                    $aes1->Chiper($_POST['hash']);
                    $aes1->setKey($_POST['key']);
                    $aes1->setIv($_POST['iv']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $aes1->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $aes1->Dekrip();
                        break;
                    }
                    break;
                    case 'AES-256-CTR':
                    $aes1 = new AES();
                    $aes1->setInput($_POST['input']);
                    $aes1->Chiper($_POST['hash']);
                    $aes1->setKey($_POST['key']);
                    $aes1->setIv($_POST['iv']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $aes1->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $aes1->Dekrip();
                        break;
                    }
                    break;
                    case 'RSA':
                    $rsa = new RSA();
                    $rsa->setInput($_POST['input']);
                    $rsa->setPublicKey($_POST['public_key']);
                    $rsa->setPrivateKey($_POST['private_key']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $rsa->Enkrip($_POST['selected_key']);
                        break;
                        case 'dekripsi' :
                            $output = $rsa->Dekrip($_POST['selected_key']);
                        break;
                    }
                    break;
                    case 'RC4':
                    $cc = new RC4();
                    $cc->setInput($_POST['input']);
                    $cc->setKey($_POST['key']);
                    switch($_POST['tipe'])
                    {
                        case 'enkripsi' :
                            $output = $cc->Enkrip();
                        break;
                        case 'dekripsi' :
                            $output = $cc->Dekrip();
                        break;
                    }
                    break;
                }
            echo "Hasil = ".$output;
            }
            ?>
        </div>
    </body>
</html>