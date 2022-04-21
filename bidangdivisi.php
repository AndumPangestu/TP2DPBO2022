<?php

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/BidangDivisi.class.php");
include("class/Divisi.class.php");


$bidang = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidang->open();



if (isset($_POST["add"])) {

    $bidang->add($_POST);
} else if (isset($_GET["id_hapus"])) {

    $bidang->delete("id_bidang", $_GET["id_hapus"]);
}

$bidang->getBidangDivisi();

$data = null;

while (list($id_bidang, $jabatan, $id_divisi) = $bidang->getResult()) {
    $data .= "<tr>
    <td>" . $id_bidang . "</td>
    <td>" . $jabatan . "</td>
    <td>" . $id_divisi . "</td>
    <td>
    <a href='bidangdivisi.php?id_hapus=" . $id_bidang . "' class='btn btn-danger' '>Hapus</a>
    </td>
    </tr>";
}

$bidang->close();


$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$divisi->getDivisi();

$datadiv = null;

while (list($id_divisi, $nama_divisi) = $divisi->getResult()) {
    $datadiv .= "<option value='$id_divisi'>$id_divisi - $nama_divisi</option>";
}

$divisi->close();


$tampilan = new Template("templates/bidangdivisi.html");
$tampilan->replace("DATA_TABEL", $data);
$tampilan->replace("Option", $datadiv);
$tampilan->write();