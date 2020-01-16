<?php
if (!isset($_GET['id'])) header("Location: index.php");
require('functions.php');

isLoggedIn();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);

$query = "SELECT d.id, d.id_jenis, j.slug, j.name AS jenis_film, d.judul, d.img, d.sutradara, d.pemain_utama, d.harga, d.sinopsis, d.thn_terbit
    FROM dvd AS d
    LEFT JOIN jenis AS j
    ON d.id_jenis = j.id
WHERE d.id = '$id'";

$result = $koneksi->query($query);
$data = $result->fetch_object();

echo json_encode($data);
