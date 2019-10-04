<?php

if (!isset($_GET['id'])) header("Location: ?page=mahasiswa");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$hapus = $mahasiswa->hapusMahasiswa($id);

?>

<script type="text/javascript">
    alert('Berhasil menghapus data mahasiswa');
    window.location.href = "?page=mahasiswa";
</script>