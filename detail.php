<?php

use LDAP\Result;

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/Pengurus.class.php");
include("class/BidangDivisi.class.php");



$data = explode(",", $_GET['data']);



$img = '<img src="images/' . $data[0] .  '"id="gamtuj" class="img-fluid rounded-pill w-60" alt="...">';
$nim = '<h6 class="fw-bold" id="temtuj">' .  $data[1] . '</h6>';
$nama = '<h6 class="fw-bold" id="temtuj">' . $data[2] . '</h6>';
$id_bidang = '<h6 class="fw-bold" id="temtuj">' . $data[3] . '</h6>';
$jabtan = '<h6 class="fw-bold" id="temtuj">' . $data[4] . '</h6>';
$tombol = '<a class="btn btn-dark mb-5" href="updatepengurus.php?id_edit=' . $data[1] . '"
        style="background-color: rgba(63, 61, 86, 1); width: 174px; height: 39px; ">Edit</a>
        <a class="btn btn-dark mb-5" href="index.php?id_hapus=' . $data[1] . '"
        style="background-color: rgba(63, 61, 86, 1); width: 174px; height: 39px; ">Delete</a>';


$tampilan = new Template("templates/detail.html");
$tampilan->replace("gambar", $img);
$tampilan->replace("nim", $nim);
$tampilan->replace("nama", $nama);
$tampilan->replace("jabatan", $jabtan);
$tampilan->replace("idbid", $id_bidang);
$tampilan->replace("Tombol", $tombol);
$tampilan->write();