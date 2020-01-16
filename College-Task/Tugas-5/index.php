<?php
require('functions.php');
isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko film serba ada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href='./css/style.css' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class='container'>
        <header>
            <div class='header'>
                <h1>Toko film serba ada</h1>
            </div>
            <?php if (isset($_GET['pesan'])) : ?>
                <p class='alert alert-success'><?= strip_tags(htmlentities($_GET['pesan'])); ?></p>
            <?php endif; ?>
        </header>
        <section>
            <h2>Selamat datang! di Toko Film Serba ada</h2>
            <hr /><br />
            <div class='operasi'>
                <a href='tambah_film.php' class='btn btn-primary'>Tambah Data Film</a> || <a href='tambah_jenis.php' class='btn btn-success'>
                    Tambah jenis film</a> || <a href='logout.php' class='btn btn-danger'>Logout</a>
            </div>
            <p>
                <h3>Pilih kategori film yang anda cari</h3>
            </p>
            <?php
            // memilih jenis film yang unik
            $query = "SELECT jenis.*, COUNT(dvd.id_jenis) as total FROM jenis LEFT JOIN dvd ON jenis.id=dvd.id_jenis GROUP BY jenis.id ORDER BY total DESC";
            $result = $koneksi->query($query);
            $no = 1;
            if ($result->num_rows > 0) :
                ?>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($data = $result->fetch_object()) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><a href='jenis.php?jenis=<?= $data->slug; ?>'><?= $data->name; ?></a></td>
                            <td><?= isset($data->total) ? $data->total : 0; ?></td>
                            <td>
                                <a href='jenis.php?jenis=<?= $data->slug; ?>' class='btn btn-success mr-3'>lihat dvd</a>
                                <a href='edit_jenis.php?id=<?= $data->id; ?>' class='btn btn-primary mr-3'>edit</a>
                                <a href='hapus_jenis.php?id=<?= $data->id; ?>' class='btn btn-danger' onclick='return confirm("Apakah kamu ingin menghapus ini?");'>hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
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