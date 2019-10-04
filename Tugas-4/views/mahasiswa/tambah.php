<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="./assets/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Mahasiswa</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="?page=mahasiswa">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="?page=mahasiswa" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mahasiswa
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?page=mahasiswa&action=tambah">Tambah Mahasiswa</a>
                                <a class="dropdown-item" href="?page=mahasiswa&action=index">Semua Mahasiswa</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="?page=jurusan" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jurusan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?page=jurusan&action=tambah">Tambah Jurusan</a>
                                <a class="dropdown-item" href="?page=jurusan&action=index">Semua Jurusan</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <main>
            <div class="post">
                <h2>Menambah Data Mahasiswa</h2>
                <hr />
                <?php
                $formDisabled = "";
                if ($jurusan->tampilJurusan()->num_rows == 0) {
                    $formDisabled = "disabled";
                    echo "<p class='alert alert-danger'>Jurusan tidak ada. <a href='?page=jurusan&action=tambah'>Tambah</a> jurusan</p>";
                } ?>
                <fieldset <?= $formDisabled; ?>>
                    <?php
                    if (isset($_POST['submit'])) {
                        $tambah = $mahasiswa->tambahMahasiswa($_POST);
                        if ($tambah) {
                            echo "<script>alert('Berhasil menambahkan data mahasiswa');";
                            echo "window.location.href='?page=mahasiswa';</script>";
                        } else {
                            echo "<div class='alert alert-danger'>
                                    Gagal menambahkan data!
                                </div>";
                        }
                    }
                    ?>
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" id="nim" placeholder="Enter nim" name="nim" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="custom-select">
                                    <?php
                                    $dataJurusan = $jurusan->tampilJurusan();
                                    if ($dataJurusan->num_rows == 0) :
                                        echo "<option value=''>Tidak ada jurusan</option>";
                                    else :
                                        while ($jrs = $dataJurusan->fetch_object()) :
                                            echo "<option value='{$jrs->id}'>{$jrs->nama}</option>";
                                        endwhile;
                                    endif;
                                    ?>
                                </select>
                                <small class="text-muted form-text">Tidak ada jurusan yang sesuai? <a href='?page=jurusan&action=tambah'>tambah</a> jurusan terlebih dahulu</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" placeholder="Enter alamat" name="alamat"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </fieldset>
            </div>
        </main>
    </div>

    <footer>
        <div class="footer">
            <p>Copyright &copy;2019</p>
        </div>
    </footer>

    <script src="./assets/js/jquery-3.4.1.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>