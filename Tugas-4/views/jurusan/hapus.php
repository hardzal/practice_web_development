<?php

if (!isset($_GET['id'])) header("Location: ?page=jurusan");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$hapus = $jurusan->hapusJurusan($id);

?>

<script type="text/javascript">
    alert('Berhasil menghapus data jurusan');
    window.location.href = "?page=jurusan";
</script>