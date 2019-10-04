<?php if (!isset($_GET['id'])) header("Location: ?page=jurusan"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Jurusan</title>
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
                <h2>Memperbaharui Data Jurusan</h2>
                <?php
                if (isset($_POST['submit'])) {
                    $tambah = $jurusan->ubahJurusan($_POST);
                    if ($tambah) {
                        echo "<script>alert('Berhasil memperbaharui data jurusan');";
                        echo "window.location.href='?page=jurusan';</script>";
                    } else {
                        echo "<div class='alert alert-danger'>
                                Gagal menambahkan data!
                            </div>";
                    }
                }
                $jrs = $jurusan->tampilJurusan($_GET['id'])->fetch_object();
                ?>
                <hr />
                <form method="POST" action="">
                    <div class="form-group row">
                        <label for="jurusan" class="col-md-2 col-form-label">Jurusan</label>
                        <input type="text" name="nama" class="form-control col-md-8" id="jurusan" value="<?= $jrs->nama; ?>" />
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-2 col-form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control col-md-8" name="deskripsi"><?= $jrs->deskripsi; ?></textarea>
                    </div>
                    <input type="hidden" value="<?= $jrs->id; ?>" name="id" />
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
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