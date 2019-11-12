<?php
include "koneksi.php";

function isLoggedIn()
{
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php?pesan=Anda Harus Login");
	}
}

function isLogged()
{
	if (isset($_SESSION['user_id'])) {
		header("Location: index.php");
	}

	return false;
}

function authenticate()
{
	global $koneksi;
	if (isset($_POST['submit'])) {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		// metthod standard
		$query = "SELECT * FROM users WHERE username='$username'";

		$result = $koneksi->query($query);

		if ($result->num_rows == 1) {
			// die(var_dump($_POST));
			$user = $result->fetch_object();
			// die(var_dump($user));
			if (password_verify($password, $user->password)) {
				$_SESSION['user_id'] = $user->id;
				$_SESSION['username'] = $user->username;
				header("Location: index.php?pesan=Berhasil Login!");
			} else {
				header("Location: login.php?pesan=Password salah");
			}
		} else {
			header("Location: login.php?pesan=Username tidak ditemukan");
		}
	}
}


function logout()
{
	global $connect;
	unset($_SESSION['user_id']);
	unset($_SESSION['username']);
}

function uploadGambar($img_name) {
	if(isset($_FILES['img']['tmp_name']) && !empty($_FILES['img']['tmp_name'])) {
		$name = $_FILES['img']['name'];
		$size = $_FILES['img']['size'];
		$type = $_FILES['img']['type'];
		$tmp = $_FILES['img']['tmp_name'];
		$error = $_FILES['img']['error'];

		$destination = "img/";

		if(!$error) {
			if(file_exists($destination.$img_name)) {
				unlink($destination.$img_name);
			}
			move_uploaded_file($tmp, $destination.$name);

			return $name;
		} else {
		echo "<script>
			alert(`Terdapat error! {$error}`);
			window.location.href = 'index.php';
		</script>";	
		}
	} else {
		return 'default-image.jpg';
	}
}

function insertFilm() {
	global $koneksi;
	$judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_STRING);
	$id_jenis = filter_input(INPUT_POST, 'id_jenis', FILTER_SANITIZE_NUMBER_INT);
	$sutradara = filter_input(INPUT_POST, 'sutradara', FILTER_SANITIZE_STRING);
	$pemain = filter_input(INPUT_POST, 'pemain_utama', FILTER_SANITIZE_STRING);
	$harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_NUMBER_FLOAT);
	$tahun = filter_input(INPUT_POST, 'tahun', FILTER_SANITIZE_NUMBER_INT);
	$sinopsis = filter_input(INPUT_POST, 'sinopsis', FILTER_SANITIZE_STRING);

	$img_name = uploadGambar();

	$query = "INSERT INTO dvd VALUES('', '$id_jenis', '$judul', '$sinopsis', '$img_name', '$sutradara', '$pemain', '$harga', '$tahun', now(), '')";

	$result = $koneksi->query($query);

	if($result) {
		echo "<script>
			alert('Berhasil menambahkan data film');
			window.location.href = 'index.php';
		</script>";	
	} else {
		echo "<script>
			alert('Gagal menambahkan data film');
			window.location.href = 'tambah.php';
		</script>";	
	}
}

function insertKategoriFilm() {
	global $koneksi;
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_STRING);

	$query = "INSERT INTO jenis VALUES('', '$name', '$slug', now(), '');";

	$result = $koneksi->query($query);

	if($result) {
		echo "<script>
			alert('Berhasil menambahkan data kategori film');
			window.location.href = 'index.php';
		</script>";	
	} else {
		echo "<script>
			alert('Gagal menambahkan data kategori film');
			window.location.href = 'index.php';
		</script>";	
	}
}

function updateFilm($id) {
	global $koneksi;
	$judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_STRING);
	$id_jenis = filter_input(INPUT_POST, 'id_jenis', FILTER_SANITIZE_NUMBER_INT);
	$sutradara = filter_input(INPUT_POST, 'sutradara', FILTER_SANITIZE_STRING);
	$pemain = filter_input(INPUT_POST, 'pemain_utama', FILTER_SANITIZE_STRING);
	$harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_NUMBER_FLOAT);
	$tahun = filter_input(INPUT_POST, 'tahun', FILTER_SANITIZE_NUMBER_INT);
	$sinopsis = filter_input(INPUT_POST, 'sinopsis', FILTER_SANITIZE_STRING);
	$img_name = filter_input(INPUT_POST, 'img_name', FILTER_SANITIZE_STRING);
	
	$img_new = uploadGambar($img_name);
	

	if($img_name == 'default-image.jpg') {
		$img_new = $img_name;
	}

	$img = "img = '$img_new',";

	$query = "UPDATE dvd SET id_jenis = '$id_jenis', judul = '$judul', sinopsis = '$sinopsis', ". $img ." sutradara =  '$sutradara', pemain_utama = '$pemain', harga = '$harga', thn_terbit = '$tahun', updated_at = now()";

	$result = $koneksi->query($query);

	if($result) {
		echo "<script>
			alert('Berhasil memperbaharui data film');
			window.location.href = 'index.php';
		</script>";	
	} else {
		echo "<script>
			alert('Gagal memperbaharui data film');
			window.location.href = 'tambah.php';
		</script>";	
	}
}

function updateJenisFilm($id) {
	global $koneksi;
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_STRING);
	$query = "UPDATE jenis SET name = '$name', slug = '$slug', updated_at = now() WHERE id = '$id'";

	$result = $koneksi->query($query);

	if($result) {
		echo "<script>
			alert('Berhasil memperbaharui data kategori film');
			window.location.href = 'index.php';
		</script>";	
	} else {
		echo "<script>
			alert('Gagal memperbaharui data kategori film');
			window.location.href = 'index.php';
		</script>";	
	}
}
