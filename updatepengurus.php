<?php

include("conf.php");
include("class/DB.class.php");
include("class/Template.class.php");
include("class/Pengurus.class.php");
include("class/BidangDivisi.class.php");


$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

$pengurus->getPengurus();

$tnim  = null;

var_dump($_GET["id_edit"]);

while (list($nim, $nama, $semester, $id_bidang, $img) = $pengurus->getResult()) {

    if ($nim === $_GET["id_edit"]) {
        $tnim  = '<input type="text" class="form-control" name="nim" id="nim" value = "' . $nim .  '">';
        $tnama = '<input type="text" class="form-control" name="nama" id="nama" value = "' . $nama . '">';
        $tsemester = $semester;
        $tidbidang = $id_bidang;
        $timage = '<br><img src="images/' . $img . '" class="img-thumbnail" alt="" style="height: 200px;">' .
            '<br>';
    }
}

$pengurus->close();


$bidang = new BidangDivisi($db_host, $db_user, $db_pass, $db_name);
$bidang->open();
$bidang->getBidangDivisi();

$databid = null;

while (list($id_bidang, $jabatan, $id_divisi) = $bidang->getResult()) {
    $databid .= "<option value='$id_bidang'>$id_bidang - $jabatan</option>";
    if ($id_bidang === $tidbidang) {

        $tidbidang .= "- " . $jabatan;
    }
}

$bidang->close();



$tampilan = new Template("templates/updatePengurus.html");
$tampilan->replace("tnim", $tnim);
$tampilan->replace("tnama", $tnama);
$tampilan->replace("Choose Semester", $tsemester);
$tampilan->replace("Choose Id Bidang", $tidbidang);
$tampilan->replace("timage", $timage);
$tampilan->replace("Option", $databid);

$tampilan->write();