<?php
if (!isset($_GET['id'])) header("Location: index.php");
require('koneksi.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko film serba ada</title>
    <link href='./css/style.css' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class='container'>
        <header>
            <div class='header'>
                <h1>Toko film serba ada</h1>
            </div>
        </header>
        <?php
        $query = "SELECT d.id, d.id_jenis, j.slug, j.name AS jenis_film, d.judul, d.img, d.sutradara, d.pemain_utama, d.harga, d.sinopsis, d.thn_terbit
            FROM dvd AS d
            LEFT JOIN jenis AS j
            ON d.id_jenis = j.id
        WHERE d.id = '$id'";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_object($result);
        ?>
        <section>
            <h2>Selamat datang! di Toko Film Serba ada</h2>
            <hr /><br />
            <a href='index.php' class='tambah red'>Home</a> || <a href='kategori.php?jenis=<?= $data->slug; ?>' class='tambah blue'>Kembali</a>
            <h3>Berikut detail dari film : <?= $data->judul; ?></h3>
            <hr /><br />
            <table>
                <tr>
                    <td>Image</td>
                    <td>:</td>
                    <td><img src='./img/<?= $data->img; ?>'></td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?= $data->judul; ?></td>
                </tr>
                <tr>
                    <td>Sinopsis</td>
                    <td>:</td>
                    <td><?= $data->sinopsis; ?></td>
                </tr>
                <tr>
                    <td>Sutradara Film</td>
                    <td>:</td>
                    <td><?= $data->sutradara; ?></td>
                </tr>
                <tr>
                    <td>Pemain Utama</td>
                    <td>:</td>
                    <td><?= $data->pemain_utama; ?></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td><?= $data->harga; ?></td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td>:</td>
                    <td><?= $data->thn_terbit; ?></td>
                </tr>
            </table>
            <p>Alamat : Jl. Condong kiri ditangkap polisi</p>
            <p>Email : <a href=' malilto:dvdstore@serba-ada.com'>dvdstore@serba-ada.com</a> </p>
        </section>
    </div>
</body>

</html>