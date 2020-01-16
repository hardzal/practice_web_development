<?php
if(!isset($_GET['id'])) header("Location: index.php");
require('functions.php');

isLoggedIn();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT * FROM jenis WHERE id = '$id'";

$result = $koneksi->query($query);

$data = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko film serba ada | Tambah data Jenis</title>
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
            <a href='index.php' class="btn btn-primary">Home</a> || <a href='logout' class='btn btn-danger'>Logout</a>
            <p>
                <h3>Menambah Data Jenis Film</h3>
            </p>
            <?php if(isset($_POST['submit'])) updateJenisFilm($id);?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type='text' name='name' maxlength='20' required value="<?= $data->name;?>"/></td>
                    </tr>
                    <tr>
                        <td>Permalink</td>
                        <td>:</td>
                        <td><input type='text' name='slug' maxlength='30' required value="<?= $data->slug;?>"/></td>
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