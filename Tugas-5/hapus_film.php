<?php
if(!isset($_GET['id'])) header("Location: index.php");

require "functions.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = $koneksi->query("DELETE FROM dvd WHERE id = '$id'");

if($query) {
	echo "<script>
			alert('Berhasil menghapus data film');
			window.location.href = 'jenis.php?id=$id';
		</script>";	
} else {
	echo "<script>
			alert('Gagal menghapus data film');
			window.location.href = 'jenis.php?id=$id';
		</script>";	
}