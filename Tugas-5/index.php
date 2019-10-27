<?php require('koneksi.php'); ?>
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
        <section>
            <h2>Selamat datang! di Toko Film Serba ada</h2>
            <hr /><br />
            <div class='operasi'>
                <a href='tambah.php' class='tambah blue'>Tambah Data Film</a> || <a href='tambah_jenis.php' class='tambah red'>Tambah jenis film</a>
            </div>
            <p>
                <h3>Pilih kategori film yang anda cari</h3>
            </p>
            <?php
            // memilih jenis film yang unik
            $query = "SELECT * FROM jenis";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) :
                ?>
                <ul type='square'>
                    <?php while ($data = mysqli_fetch_array($result)) : ?>
                        <li><a href='kategori.php?jenis=<?= $data['slug']; ?>'><?= $data['name']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>Tidak ada data kategori film</p>
            <?php endif; ?>
            <hr /><br />
            <p>Alamat : Jl. Condong kiri ditangkap polisi</p>
            <p>Email : <a href='malilto:dvdstore@serba-ada.com'>dvdstore@serba-ada.com</a> </p>
        </section>
    </div>
</body>

</html>