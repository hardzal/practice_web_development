<?php

class Jurusan
{
    private $mysqli;
    private $table = "jurusan";

    public function __construct($db)
    {
        $this->mysqli = $db;
    }

    public function tampilJurusan($id = null)
    {
        $query = "SELECT * FROM " . $this->table;

        if ($id != null) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $query .= " WHERE jurusan.id = ?";

            $stmt = $this->mysqli->prepare($query);

            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return $stmt->get_result();
            }
        }

        $query .= " ORDER BY id ASC";
        $result = $this->mysqli->query($query) or die("Error: " . $this->mysqli->connect_error);

        return $result;
    }

    public function tambahJurusan($data)
    {   // FILTERING
        $nama = filter_var($data['jurusan'], FILTER_SANITIZE_STRING);
        $deskripsi = filter_var($data['deskripsi'], FILTER_SANITIZE_STRING);

        $query = "INSERT INTO " . $this->table . " SET nama = ?, deskripsi = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("ss", $nama, $deskripsi);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function ubahJurusan($data)
    {
        // FILTERING
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        $nama = filter_var($data['nama'], FILTER_SANITIZE_STRING);
        $deskripsi = filter_var($data['deskripsi'], FILTER_SANITIZE_STRING);

        $query = "UPDATE " . $this->table . " SET nama = ?, deskripsi = ? WHERE id = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("ssi", $nama, $deskripsi, $id);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function hapusJurusan($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return $stmt->affected_rows;
        }

        return false;
    }

    public function cariJurusan($keyword, $search)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE " . $keyword . " LIKE '%$search%' ORDER BY id ASC";

        $result = $this->mysqli->query($query) or die("ERROR :" . $this->mysqli->connect_error);

        return $result;
    }
}
