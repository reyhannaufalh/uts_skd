<?php
class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "uts_skd";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed :" . $this->conn->connect_error);
        }
    }

    //memasukkan data(registrasi)
    public function insert($firstname, $lastname, $address, $username, $email, $passwordMd5, $passwordSha1, $passwordSha256)
    {
        $sql = "INSERT INTO user VALUES (null, '$firstname','$lastname','$address','$username','$email','$passwordMd5','$passwordSha1','$passwordSha256')";
        return $this->conn->query($sql);
    }

    //verifikasi akun (mencocokan password/login)
    public function verifyAccount($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username='$username'";

        if ($this->conn->query($sql)) {
            $result = mysqli_fetch_array($this->conn->query($sql)); //array hasil query lengkap

            //mencocokkan password MD5, SHA1, dan SHA256
            if ($result['password_md5'] == md5($password) && $result['password_sha1'] == hash('sha1', $password) && $result['password_sha256'] == hash('sha256', $password)) {
                //return sebagai array hasil query lengkap
                return $result;
            } else {
                return null;
            }
        } else {
            return false;
        }
    }
}