<?php

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/Pengurus.class.php");
include("class/BidangDivisi.class.php");


$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

if (isset($_POST["add"])) {

    $pengurus->add($_POST);
} else if (isset($_GET["id_hapus"])) {

    $pengurus->delete("nim", $_GET["id_hapus"]);
} else if (isset($_POST["update"])) {

    $pengurus->update($_POST);
}



$pengurus->getPengurus();

$data = null;
while (list($nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult()) {
    $data .= "<tr>
    <td>" .  "<img src='images/$img'
    class='img-fluid' style='height:100px' alt='...'>" . "</td>
    <td>" . $nim . "</td>
    <td>" . $nama . "</td>
    <td>" . $semester . "</td>
    <td>" . $id_bidang . "</td>
    <td>
    <a href='updatepengurus.php?id_edit=" . $nim .  "' class='btn btn-warning' '>Edit</a>
    <a href='tambahpengurus.php?id_hapus=" . $nim . "' class='btn btn-danger' '>Hapus</a>
    </td>
    </tr>";
}

$pengurus->close();


$bidang = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidang->open();
$bidang->getBidangDivisi();

$databid = null;

while (list($id_bidang, $jabatan, $id_divisi) = $bidang->getResult()) {
    $databid .= "<option value='$id_bidang'>$id_bidang - $jabatan</option>";
}

$bidang->close();



$tampilan = new Template("templates/tambahPengurus.html");
$tampilan->replace("DATA_TABEL", $data);
$tampilan->replace("Option", $databid);
$tampilan->write();