<?php
require_once 'baza.class.php';
$db = new baza('localhost','WebDiP2014x043','admin_d4zt','WebDiP2014x043');
$db->spojiDB();

$naslov = 'Popis sanmova';
include './_header.php';

echo "<h3>Sajmovi</h3>";

$sql = "select sajam.id_sajam, sajam.lokacija, count(id_automobil) from automobil,korisnik_has_automobil, korisnik, prodavac, sajam_has_prodavac, sajam where sajam_has_prodavac.sajam_id_sajam = sajam.id_sajam and sajam_has_prodavac.prodavac_id_prodavac = prodavac.id_prodavac and prodavac.korisnik_id_korisnik = korisnik.id_korisnik and korisnik.id_korisnik = korisnik_has_automobil.korisnik_id_korisnik and korisnik_has_automobil.automobil_id_automobil = automobil.id_automobil";
$rezultat = $db->selectDB($sql);

$table = "<table id='sajmovi'>
            <tr>
            <td>Sajmovi(lokacija)</td>
            <td>Broj Automobila</td>";


while ($red = mysqli_fetch_array($rezultat)) {
    $table .= "<tr>";
    $table .= "<td><a href='/WebDiP/2014_projekti/WebDiP2014x043/vidi_sajam.php?id=" . $red["id_sajam"] . "'>" .$red["lokacija"] ."</a></td>";
    $table .= "<td>. $red[2] .</td>";
    $table .= "<tr>";
}

echo $table;



include './_footer.php';
?>