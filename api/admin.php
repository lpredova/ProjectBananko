<?php
include_once '../baza.class.php';
$baza = new Baza();

//sajmovi
if (isset($_POST["sajmovi"])) {

    $odgovor = array();
    $final = array();
    $b = 0;

    $sql = "select * from sajam";
    $rezultat = $baza->selectDB($sql);
    while ($red = mysqli_fetch_array($rezultat)) {
        $final[$b] = $red["id_sajam"];
        $final[$b] = $red["lokacija"];
        $final[$b] = $red["pocetak"];
        $final[$b] = $red["kraj"];
        $final[$b] = $red["aktivan"];
        $b++;
        $odgovor[] = $final;
    }

    $odgovor[] = $final;
    echo json_encode($odgovor);
}

if (isset($_POST["moderatori"])) {

    $odgovor = array();
    $sql = "select * from korisnik where tip_korisnika_id_tip_korisnika = 2";
    $rezultat = $baza->selectDB($sql);
    while ($red = mysqli_fetch_array($rezultat)) {
        $odgovor[] = $red;
    }
    echo json_encode($odgovor);
}

if (isset($_POST["dnevnik"])) {

    $odgovor = array();
    $sql = "select d.id_dnevnik_rada as id,d.radnja,d.vrijeme,k.korisnicko_ime as korisnik from dnevnik_rada d join korisnik k on k.id_korisnik=d.korisnik_id_korisnik";
    $rezultat = $baza->selectDB($sql);
    while ($red = mysqli_fetch_array($rezultat)) {
        $odgovor[] = $red;
    }
    echo json_encode($odgovor);
}