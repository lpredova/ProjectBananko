<?php
//vrijeme.txt
require_once('baza.class.php');
$db = new baza('localhost','WebDiP2014x043','admin_d4zt','WebDiP2014x043');
$db->spojiDB();

$naslov = 'Vidi sajam';
include './_header.php';


if(isset($_GET['id'])){
    $sajam = $_GET['id'];

    $sql = "select automobil.marka, automobil.godiste, automobil.kilometraza from automobil,korisnik_has_automobil, korisnik, prodavac, sajam_has_prodavac, sajam where sajam_has_prodavac.sajam_id_sajam = $sajam and sajam_has_prodavac.prodavac_id_prodavac = prodavac.id_prodavac and prodavac.korisnik_id_korisnik = korisnik.id_korisnik and korisnik.id_korisnik = korisnik_has_automobil.korisnik_id_korisnik and korisnik_has_automobil.automobil_id_automobil = automobil.id_automobil";
    $rezultat = $db->selectDB($sql);

    $table = "<table id='sajmovi'>
            <tr>
            <td>naziv</td>
            <td>godiste</td>
            <td>kilometraza</td>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>. $red[0] .</td>";
        $table .= "<td>. $red[1] .</td>";
        $table .= "<td>. $red[2] .</td>";
        $table .= "<tr>";
    }

    echo $table;

}

include './_footer.php';