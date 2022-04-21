<?php

class Divisi extends DB
{
    function getDivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function add($data)
    {
        $name = $data['nama_divisi'];

        $query = "INSERT INTO divisi values ('', '$name')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        $id = $data['id'];
        $name = $data['nama_divisi'];

        $query = "UPDATE divisi SET nama_divisi = '$name' WHERE id = $id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM divisi WHERE id_divisi = $id";

        // Mengeksekusi query
        return $this->execute($query);
    }
}