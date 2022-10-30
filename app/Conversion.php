<?php
class CaesarChiper
{
    private $input;
    private $key; //integer
    private $output;

    private function Chiper($chiper,$key)
    {
        if(!ctype_alpha($chiper))
            return $chiper;
        
        $offset = ord(ctype_upper($chiper)? 'A' :'a');
        return chr(fmod(((ord($chiper)+$key) - $offset),26) + $offset);
    }

    public function Enkrip()
    {
        $inputArray = str_split($this->input);
        foreach ($inputArray as $chiper)
            $this->output .= $this->Chiper($chiper,$this->key);
        return $this->output;
    }

    public function Dekrip()
    {
        $inputArray = str_split($this->input);
        foreach ($inputArray as $chiper)
            $this->output .= $this->Chiper($chiper,26 - $this->key);
        return $this->output;
    }

    public function setInput($input)
    {
        $this->input = $input;
    }
    public function setKey($key)
    {
        $this->key = $key;
    }
    public function getKey()
    {
        return $this->key;
    }
    public function getOutput()
    {
        return $this->output;
    }
}
class VigenereChiper
{
    private $input;
    private $key; //string
    private $output;

    private function Mod($a, $b)
    {
        return ($a % $b + $b) % $b;
    }

    private function Cipher($input, $key, $encipher)
    {
        $keyLen = strlen($key);

        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($key[$i]))
                return ""; // Error

        $output = "";
        $nonAlphaCharCount = 0;
        $inputLen = strlen($input);

        for ($i = 0; $i < $inputLen; ++$i)
        {
            if (ctype_alpha($input[$i]))
            {
                $cIsUpper = ctype_upper($input[$i]);
                $offset = ord($cIsUpper ? 'A' : 'a');
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen;
                $k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset;
                $k = $encipher ? $k : -$k;
                $ch = chr(($this->Mod(((ord($input[$i]) + $k) - $offset), 26)) + $offset);
                $output .= $ch;
            }
            else
            {
                $output .= $input[$i];
                ++$nonAlphaCharCount;
            }
        }

        return $output;
    }

    public function Enkrip()
    {
        $this->output = $this->Cipher($this->input, $this->key, true);
        return $this->output;
    }
    public function Dekrip()
    {
        $this->output = $this->Cipher($this->input, $this->key, false);
        return $this->output;
    }
    public function setInput($input)
    {
        $this->input = $input;
    }
    public function setKey($key)
    {
        $this->key = $key;
    }
    public function getKey()
    {
        return $this->key;
    }
    public function getOutput()
    {
        return $this->output;
    }
}
class AES
{
    private $input;
    private $key; //self generated string (unicode)
    private $iv; //semacam key tambahan, self generated string (unicode)
    private $output;
    private $chiper;

    public function Chiper($tipe) //aes-128-cbc,aes-256-cbc,aes-128-ctr,aes-256-ctr
    {
        $this->chiper = $tipe;
        $this->key = openssl_random_pseudo_bytes(32);
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->chiper));
    }
    public function Enkrip()
    {
        $this->output = openssl_encrypt($this->input, $this->chiper, $this->key, 0, $this->iv);
        return $this->output;
        
    }
    
    public function Dekrip()
    {
        $this->output = openssl_decrypt($this->input, $this->chiper, $this->key, 0, $this->iv);
        return $this->output;
    }
    public function setInput($input)
    {
        $this->input = $input;
    }
    public function setKey($key)
    {
        $this->key = base64_decode($key);
    }
    public function setIv($iv)
    {
        $this->iv = base64_decode($iv);
    }
    public function getChiper()
    {
        return $this->chiper;
    }
    public function getKey()
    {
        return base64_encode($this->key);
    }
    public function getIv()
    {
        return base64_encode($this->iv);
    }
    public function getOutput()
    {
        return $this->output;
    }

}
//untuk RSA, chiper text yg dienkrip dgn private key harus di dekrip dengan public key (dan sebaliknya).
class RSA
{
    private $input;
    private $private_key; //OpenSSLA string
    private $public_key; //OpenSSLA string
    private $output;

    public function Enkrip($tipe) //"public","private"
    {
        switch($tipe)
        {
            case "public":
                openssl_public_encrypt($this->input, $output, $this->public_key);
            break;
            case "private":
                openssl_private_encrypt($this->input, $output,$this->private_key);
            break;
        }
        $this->output = base64_encode($output);
        return $this->output;
    }
    public function Dekrip($tipe) //"public","private"
    {
        switch($tipe)
        {
            case "public":
                openssl_public_decrypt(base64_decode($this->input), $output, $this->public_key);
            break;
            case "private":
                openssl_private_decrypt(base64_decode($this->input), $output, $this->private_key);
            break;
        }
        $this->output = $output;
        return $this->output;
    }
    public function generateKey() {
        $config['config'] = dirname(__FILE__).'/openssl.cnf';
        $main_key = openssl_pkey_new(array(
            'private_key_bits'=>1024,
            'private_key_type'=> OPENSSL_KEYTYPE_RSA,
        ) + $config); //OpenSSLA-array

        $private_SSLA = openssl_pkey_get_private($main_key); //OpenSSLA-array
        openssl_pkey_export($private_SSLA, $privkey,null, array(
            'private_key_bits'=>1024,
            'private_key_type'=> OPENSSL_KEYTYPE_RSA,
        ) + $config); //string
    
        $this->private_key = $privkey; //string
    
        $this->public_key = openssl_pkey_get_details($private_SSLA)['key']; //string
      }
    public function setInput($input)
    {
        $this->input = $input;
    }
    public function setPublicKey($key)
    {
        $this->public_key = $key;
    }
    public function setPrivateKey($key)
    {
        $this->private_key = $key;
    }
    public function getPublicKey()
    {
        return $this->public_key;
    }
    public function getPrivateKey()
    {
        return $this->private_key;
    }
    public function getOutput()
    {
        return $this->output;
    }
}
class RC4
{
    private $input;
    private $key; //string
    private $output;

    private function Chiper() {
        $s = array();
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;    //inisialisasi state array
        }
        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($this->key[$i % strlen($this->key)])) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
        }
        $i = 0;
        $j = 0;
        $output = '';
        for ($y = 0; $y < strlen($this->input); $y++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            $output .= $this->input[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
        }
        return $output;
    }
    public function Enkrip()
    {
        $this->output = $this->Chiper();
        return base64_encode($this->output);
    }
    public function Dekrip()
    {
        $this->input = base64_decode($this->input);
        $this->output = $this->Chiper();
        return $this->output;
    }
    public function setInput($input)
    {
        $this->input = $input;
    }
    public function setKey($key)
    {
        $this->key = $key;
    }
    public function getKey()
    {
        return $this->key;
    }
    public function getOutput()
    {
        return $this->output;
    }
}
?>