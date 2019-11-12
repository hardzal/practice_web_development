<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_db_toko_dvdv2";

$koneksi = new mysqli($hostname, $username, $password, $dbname);

if(!$koneksi) {
    die("Error: ". $koneksi->error());
}