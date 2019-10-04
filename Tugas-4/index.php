<?php
require_once "./config/database.php";
require_once "./models/Mahasiswa.php";
require_once "./models/Jurusan.php";

$db = new Database();
$mahasiswa = new Mahasiswa($db->connect());
$jurusan = new Jurusan($db->connect());

if (!isset($_GET['page']) && empty($_GET['page'])) {
    require_once './views/mahasiswa/index.php';
} else {
    $page = filter_var($_GET['page'], FILTER_SANITIZE_URL);
    $action = isset($_GET['action']) ? $_GET['action'] : "index";

    require_once "./views/" . $page . "/" . $action . ".php";
}

$db->disconnect();

// fitur
// nambah sorting
// nambah paginasi
// nambah pencarian
// nambah export
// clean url
