<?php
if (!isset($_GET['jenis'])) header("Location: index.php");
require('functions.php');

isLoggedIn();

$slug = filter_input(INPUT_GET, 'jenis', FILTER_SANITIZE_URL);
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
        </header>
        <section>
            <h2>Selamat datang! di Toko Film Serba ada</h2>
            <hr /><br />
            <a href='index.php' class="btn btn-primary">Home</a> || <a href='logout.php' class='btn btn-danger'>Logout</a>
            <p>
                <h3>Berikut ini daftar film berdasarkan kategori</h3>
            </p>
            <?php
            // memilih jenis film yang unik
            $query = "SELECT dvd.*, jenis.name, jenis.slug FROM dvd INNER JOIN jenis ON dvd.id_jenis = jenis.id WHERE jenis.slug='$slug'";
            $result = $koneksi->query($query);
            if ($result->num_rows > 0) :
                ?>
                    <div class="row">
                    <?php while ($data = $result->fetch_object()) : ?>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                              <img src="img/<?=$data->img;?>" class="card-img-top" alt="<?= $data->title;?>">
                              <div class="card-body">
                                <h5 class="card-title"><?= $data->title;?></h5>
                                <p class="card-text"><?= $data->sinopsis;?></p>
                                <a href="#<?= $data->id;?>" class="detail btn btn-primary" data-toggle="modal" data-target="#detailModal" data-id="<?=$data->id;?>">Detail</a>
                                <a href="edit_film.php?id=<?= $data->id;?>" class="btn btn-success">Update</a>
                                <a href="hapus_film.php?id=<?= $data->id;?>" class="btn btn-danger">Delete</a>
                              </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </div>
            <?php else : ?>
                <p>Tidak ada data film</p>
            <?php endif; ?>
            <hr /><br />
            <p>Alamat : Jl. Condong kiri ditangkap polisi</p>
            <p>Email : <a href=' malilto:dvdstore@serba-ada.com'>dvdstore@serba-ada.com</a> </p>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="img/default-image.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text sinopsis">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item sutradara">Cras justo odio</li>
                        <li class="list-group-item pemain">Dapibus ac facilisis in</li>
                        <li class="list-group-item tahun">Vestibulum at eros</li>
                        <li class="list-group-item harga">Vestibulum at eros</li>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
