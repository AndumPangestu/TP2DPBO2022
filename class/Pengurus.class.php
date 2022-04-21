<?php

class Pengurus extends DB
{
    function getPengurus()
    {
        $query = "SELECT * FROM pengurus";
        return $this->execute($query);
    }

    function add($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data["id_bidang"];


        $pname = rand(1000, 10000) . "-" . $_FILES["image"]["name"];


        $tname = $_FILES["image"]["tmp_name"];


        $uploads_dir = 'images';

        move_uploaded_file($tname, $uploads_dir . '/' . $pname);



        $query = "INSERT INTO pengurus values ('$nim', '$nama', '$semester', '$id_bidang', '$pname')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data["id_bidang"];

        $pname = rand(1000, 10000) . "-" . $_FILES["image"]["name"];


        $tname = $_FILES["image"]["tmp_name"];


        $uploads_dir = 'images';

        move_uploaded_file($tname, $uploads_dir . '/' . $pname);

        $query = "UPDATE pengurus
                  SET nama = '$nama', semester = '$semester', id_bidang='$id_bidang', img = '$pname'
                  WHERE nim = '$nim'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($col, $id)
    {

        $query = "DELETE FROM pengurus WHERE $col = '$id'";


        // Mengeksekusi query
        return $this->execute($query);
    }
}