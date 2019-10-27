<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_db_toko_dvd";

$koneksi = mysqli_connect($hostname, $username, $password, $dbname);

if(!$koneksi) {
    die("Error: ". mysqli_error($koneksi));
}