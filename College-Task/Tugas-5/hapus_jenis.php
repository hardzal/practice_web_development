<?php
if(!isset($_GET['id'])) header("Location: index.php");

require "functions.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = $koneksi->query("DELETE FROM jenis WHERE id = '$id'");

if($query) {
	echo "<script>
			alert('Berhasil menghapus data kategori film');
			window.location.href = 'index.php';
		</script>";	
} else {
	echo "<script>
			alert('Gagal menghapus data kategori film');
			window.location.href = 'index.php';
		</script>";	
}