<?php

include_once '../baza.class.php';
$baza = new Baza();

if (isset($_POST["korisnik_zauzet"])) {

    $korisnik = $_POST["korisnik"];
    $upit = "Select id_korisnik from korisnik where korisnicko_ime='" . $korisnik . "'";
    $rezultat = $baza->selectDB($upit);
    if ($rezultat->num_rows == 0) {
        $odgovor = array("zauzet" => 0);
        echo json_encode($odgovor);
    } else {
        $odgovor = array("zauzet" => 1);
        echo json_encode($odgovor);
    }

}