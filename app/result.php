<?php
(@include('koneksi.php')) or die('Tidak bisa terkoneksi ke database');
session_start();
if (!isset($_SESSION)) {
    header("location:../view/login.php");
} else {
    header("location:../index.php");
}