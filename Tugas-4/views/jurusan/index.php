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
                <?php
                $dataJurusan = $jurusan->tampilJurusan();
                $no = 1;
                if ($dataJurusan->num_rows == 0) :
                    echo "<div class='jumbotron'><p><strong>Data jurusan belum tersedia</strong></p></div>";
                else :
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($jrs = $dataJurusan->fetch_object()) :
                                    ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $jrs->nama; ?></td>
                                    <td><?= $jrs->deskripsi; ?></td>
                                    <td>
                                        <a href="./?page=jurusan&action=ubah&id=<?= $jrs->id; ?>" class="btn btn-success">Ubah</a>
                                        <a href="./?page=jurusan&action=hapus&id=<?= $jrs->id; ?>" class="btn btn-danger" onclick="return confirm('Kamu yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
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