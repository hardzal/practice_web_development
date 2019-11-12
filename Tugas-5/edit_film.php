<?php
require('functions.php');
isLoggedIn();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT * FROM dvd WHERE id = '$id'";

$result = $koneksi->query($query);

$data = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko film serba ada | Tambah data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
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
            <a href='index.php' class="btn btn-primary">Home</a> || <a href="logout" class="btn btn-danger">Logout</a>
            <p>
                <h3>Menambah Data Film</h3>
            </p>
            <?php if(isset($_POST['submit'])) updateFilm($id);?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><input type='text' name='judul' maxlength='100' required value="<?= $data->judul;?>"/></td>
                    </tr>
                    <tr>
                        <td>Jenis Film</td>
                        <td>:</td>
                        <td>
                            <?php
                            $query_jenis = "SELECT * FROM jenis";
                            $result_jenis = $koneksi->query($query_jenis);
                            if ($result_jenis->num_rows > 0) : ?>
                                <select name='id_jenis'>
                                    <?php
                                        while ($jenis = $result_jenis->fetch_object()) : ?>
                                        <option value='<?= $jenis->id; ?>'><?= $jenis->name; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            <?php else :
                                echo "Tidak ada jenis film, tambah <a href='tambah_jenis.php'>di sini</a>";
                            endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td><input type='file' name='img' /></td>
                    </tr>
                    <tr>
                        <td>Sutradara</td>
                        <td>:</td>
                        <td><input type='text' name='sutradara' maxlength='50' required value="<?= $data->sutradara;?>"/></td>
                    </tr>
                    <tr>
                        <td>Pemain Utama</td>
                        <td>:</td>
                        <td><textarea name='pemain_utama' required><?= $data->pemain_utama;?></textarea></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><input type='number' name='harga' value="<?= $data->harga;?>" required></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><input type='text' name='tahun' required minlength="4" maxlength="4" value="<?= $data->thn_terbit;?>"></td>
                    </tr>
                    <tr>
                        <td>Sinopsis</td>
                        <td>:</td>
                        <td><textarea rows='5' cols='20' name='sinopsis' required><?= $data->sinopsis;?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan='3'><input type='submit' name='submit' class="btn btn-primary"/></td>
                        <input type='hidden' name='img_name' value='<?= $data->img;?>'/>
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