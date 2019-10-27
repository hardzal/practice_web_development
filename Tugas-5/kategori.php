<?php
if (!isset($_GET['jenis'])) header("Location: index.php");
require('koneksi.php');

$slug = filter_input(INPUT_GET, 'jenis', FILTER_SANITIZE_URL);
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
        <section>
            <h2>Selamat datang! di Toko Film Serba ada</h2>
            <hr /><br />
            <a href='index.php'>Home</a>
            <p>
                <h3>Berikut ini daftar film berdasarkan kategori</h3>
            </p>
            <?php
            // memilih jenis film yang unik
            $query = "SELECT dvd.id, id_jenis, judul, img, sutradara FROM dvd INNER JOIN jenis ON dvd.id_jenis = jenis.id WHERE jenis.slug='$slug'";
            $result = mysqli_query($koneksi, $query);
            $no = 0;
            if (mysqli_num_rows($result) > 0) :
                ?>
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Judul</th>
                        <th>Sutradara</th>
                        <th>Detail</th>
                    </tr>
                    <?php while ($data = mysqli_fetch_object($result)) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><img src='./img/<?= $data->img; ?>' /></td>
                            <td><?= $data->judul; ?></td>
                            <td><?= $data->sutradara; ?></td>
                            <td><a href='detail.php?id=<?= $data->id; ?>'>detail</a></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else : ?>
                <p>Tidak ada data film</p>
            <?php endif; ?>
            <hr /><br />
            <p>Alamat : Jl. Condong kiri ditangkap polisi</p>
            <p>Email : <a href=' malilto:dvdstore@serba-ada.com'>dvdstore@serba-ada.com</a> </p>
        </section>
    </div>
</body>

</html>