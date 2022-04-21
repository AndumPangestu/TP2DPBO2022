<?php

use LDAP\Result;

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/Pengurus.class.php");
include("class/BidangDivisi.class.php");

$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();


if (isset($_GET["id_hapus"])) {

    $pengurus->delete("nim", $_GET["id_hapus"]);
    header("Location: index.php");
}

$pengurus->getPengurus();



$bidang = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidang->open();
$bidang->getBidangDivisi();
$bidang->close();

$data = null;
while (list($nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult()) {

    $res = null;
    while (list($id_bidang2, $jabatan, $id_divisi) = $bidang->getResult()) {

        if ($id_bidang === $id_bidang2) {

            $res = $jabatan;
            break;
        }
    }


    $data .= "
    <div class='col-sm' data-aos='fade-up' data-aos-duration='600'>
    <div class='card m-auto h-100 text-center' style='width: 18rem;'>
    <a href='detail.php?data=" . $img . "," . $nim . "," . $nama . "," . $id_bidang . "," . $res . "'
    class='text-dark' style='text-decoration: none;'>
    <img src='images/$img' class='card-img-top img-fluid ' alt='...'>
    <div class='card-body'>
    <h5 class='card-title fw-bold btn-light mb-3'>$nama</h5>
    <p class='card-text mb-4'>" . $res . "</p>
    </div>
    </a>
    </div>
    </div>
    ";
}


$pengurus->close();
$tampilan = new Template("templates/index.html");
$tampilan->replace("Data_Pengurus", $data);
$tampilan->write();