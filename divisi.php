<?php

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/Divisi.class.php");
include("class/BidangDivisi.class.php");
include("class/Pengurus.class.php");


$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();



if (isset($_POST["add"])) {

    $divisi->add($_POST);
} else if (isset($_GET["id_hapus"])) {


    $bidang = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
    $bidang->open();
    $bidang->getBidangDivisi();

    $databid = [];

    $inx = 0;

    while (list($id_bidang, $jabatan, $id_divisi) = $bidang->getResult()) {
        if ($id_divisi == $_GET["id_hapus"]) {

            $databid[$inx] = $id_bidang;
            $inx += 1;
        }
    }


    $pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
    $pengurus->open();

    $pengurus->getPengurus();


    for ($i = 0; $i < $inx; $i++) {

        $pengurus->delete("id_bidang", $databid[$i]);
    }

    $pengurus->close();

    $bidang->delete("id_divisi", $_GET["id_hapus"]);

    $bidang->close();

    $divisi->delete($_GET["id_hapus"]);
}

$divisi->getDivisi();

$data = null;

while (list($id_divisi, $nama_divisi) = $divisi->getResult()) {
    $data .= "<tr>
    <td>" . $id_divisi . "</td>
    <td>" . $nama_divisi . "</td>
    <td>
    <a href='divisi.php?id_hapus=" . $id_divisi . "' class='btn btn-danger' '>Hapus</a>
    </td>
    </tr>";
}

$divisi->close();
$tampilan = new Template("templates/divisi.html");
$tampilan->replace("DATA_TABEL", $data);
$tampilan->write();