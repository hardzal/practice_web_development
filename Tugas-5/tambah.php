<?php
require('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko film serba ada | Tambah data</title>
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
            <a href='index.php' class='tambah red'>Home</a>
            <p>
                <h3>Menambah Data Film</h3>
            </p>
            <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><input type='text' name='judul' maxlength='100' required /></td>
                    </tr>
                    <tr>
                        <td>Jenis Film</td>
                        <td>:</td>
                        <td>
                            <?php
                            $query_jenis = "SELECT * FROM jenis";
                            $result_jenis = mysqli_query($koneksi, $query_jenis);
                            if (mysqli_num_rows($result_jenis)) : ?>
                                <select name='jenis'>
                                    <?php
                                        while ($jenis = mysqli_fetch_object($result_jenis)) { ?>
                                        <option value='<?= $jenis->id; ?>'><?= $jenis->name; ?></option>
                                    <?php } ?>
                                </select>
                            <?php else :
                                echo "Tidak ada jenis film, tambah <a href='tambah_jenis.php'>di sini</a>";
                            endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td><input type='file' name='img' required /></td>
                    </tr>
                    <tr>
                        <td>Sutradara</td>
                        <td>:</td>
                        <td><input type='text' name='judul' maxlength='50' required /></td>
                    </tr>
                    <tr>
                        <td>Pemain Utama</td>
                        <td>:</td>
                        <td><textarea name='pemain_utama' required></textarea></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><input type='number' name='harga' required></textarea></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><input type='text' name='thn_terbit' required></textarea></td>
                    </tr>
                    <tr>
                        <td>Sinopsis</td>
                        <td>:</td>
                        <td><textarea rows='5' cols='20' name='sinopsis' required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan='3'><input type='submit' name='submit' /></td>
                    </tr>
                </table>
            </form>
            <hr /><br />
            <p>Alamat : Jl. Condong kiri ditangkap polisi</p>
            <p>Email : <a href=' malilto:dvdstore@serba-ada.com'>dvdstore@serba-ada.com</a> </p>
        </section>
    </div>
</body>

</html>