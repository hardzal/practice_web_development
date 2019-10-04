<?php

class Mahasiswa
{
    private $mysqli;
    private $table = "mahasiswa";

    public function __construct($db)
    {
        $this->mysqli = $db;
    }

    public function tampilMahasiswa($id = null)
    {
        $query = "SELECT mahasiswa.id AS id, 
                mahasiswa.nim AS nim, 
                mahasiswa.nama AS nama,
                mahasiswa.email AS email,
                mahasiswa.alamat AS alamat,
                jurusan.nama AS jurusan FROM " . $this->table .
            " INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id";

        if ($id != null) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $query .= " WHERE mahasiswa.id = ?";

            $stmt = $this->mysqli->prepare($query);

            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                return $stmt->get_result();
            }
        }

        $query .= " ORDER BY mahasiswa.nim ASC";
        $result = $this->mysqli->query($query) or die("Error: " . $this->mysqli->connect_error);

        return $result;
    }

    public function tambahMahasiswa($data)
    {   // FILTERING
        $id_jurusan = filter_var($data['jurusan'], FILTER_SANITIZE_NUMBER_INT);
        $email =  filter_var($data['email'], FILTER_SANITIZE_STRING);
        $nim = filter_var($data['nim'], FILTER_SANITIZE_STRING);
        $nama = filter_var($data['nama'], FILTER_SANITIZE_STRING);
        $alamat = filter_var($data['alamat'], FILTER_SANITIZE_STRING);

        $query = "INSERT INTO " . $this->table . " SET id_jurusan = ?, email = ?, nim = ?, nama = ?, alamat = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('issss', $id_jurusan, $email, $nim, $nama, $alamat);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function ubahMahasiswa($data)
    {
        // FILTERING
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        $id_jurusan = filter_var($data['jurusan'], FILTER_SANITIZE_NUMBER_INT);
        $email =  filter_var($data['email'], FILTER_SANITIZE_STRING);
        $nim = filter_var($data['nim'], FILTER_SANITIZE_STRING);
        $nama = filter_var($data['nama'], FILTER_SANITIZE_STRING);
        $alamat = filter_var($data['alamat'], FILTER_SANITIZE_STRING);

        $query = "UPDATE " . $this->table . " SET id_jurusan = ?, email = ?, nim = ?, nama = ?, alamat = ? WHERE id = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('issssi', $id_jurusan, $email, $nim, $nama, $alamat, $id);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function hapusMahasiswa($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);

        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function cariMahasiswa($keyword)
    {
        $query = "SELECT * FROM mahasiswa 
            INNER JOIN jurusan ON mahasiswa.id_jurusan = jurusan.id 
            WHERE mahasiswa.nama LIKE '%$keyword%' OR
                mahasiswa.nim LIKE '%$keyword%' OR 
                mahasiswa.email LIKE '%$keyword%' OR
                jurusan.nama LIKE '%$keyword%' OR
                mahasiswa.alamat LIKE '%$keyword%' OR
            ORDER BY mahasiswa.nim ASC";

        $result = $this->mysqli->query($query) or die("ERROR :" . $this->mysqli->connect_error);

        return $result;
    }
}
