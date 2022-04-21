<?php

class BidangDivisi extends DB
{
    function getBidangDivisi()
    {
        $query = "SELECT * FROM Bidang_divisi";
        return $this->execute($query);
    }

    function add($data)
    {
        $jabatan = $data['jabatan'];
        $id_divisi = $data['id_divisi'];

        $query = "INSERT INTO Bidang_divisi values ('', '$jabatan', '$id_divisi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        $id = $data['id_bidang'];
        $jabatan = $data['jabatan'];
        $id_divisi = $data['id_divisi'];


        $query = "UPDATE divisi
                  SET jabatan = '$jabatan', id_divisi = '$id_divisi'
                  WHERE id_bidang = $id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($col, $id)
    {

        $query = "DELETE FROM Bidang_divisi WHERE $col = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }


    function getJabatan($id)
    {
        $query = "SELECT * FROM Bidang_divisi WHERE id_bidang = '$id'";
        return $this->execute($query);
    }
}