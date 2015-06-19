<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");

$baza = new Baza();


if (loginUser() and !loginAdmin() and !loginMod()) {

    $poruka = "";


    include_once("header/user_header.php");
    echo "<h3>Detalji sajma</h3><br> $poruka";

    $sql = "select au.id_automobil as auto,au.marka,au.godiste,au.ocjena,au.snaga,s.id_sajam,s.lokacija from automobil au
            join korisnik_has_automobil kha on au.id_automobil=kha.automobil_id_automobil
            join korisnik k on kha.korisnik_id_korisnik=k.id_korisnik
            join sajam_has_korisnik shk on k.id_korisnik=shk.korisnik_id_korisnik
            join sajam s on s.id_sajam=shk.sajam_id_sajam where id_sajam=" . $_GET["id_sajam"];


    $rezultat = $baza->selectDB($sql);


    $table = "
            <h4>Automobili na sajmu</h4>
            <table id='sajmovi'>
            <thead>
                <th>id</th>
                <th>Marka</th>
                <th>Godiste</th>
                <th>Ocjena</th>
                <th>Snaga</th>
                <th>Lokacija automobila</th>
                <th>Detalji</th>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["auto"] . "</td>";
        $table .= "<td>" . $red["marka"] . "</td>";
        $table .= "<td>" . $red["godiste"] . "</td>";
        $table .= "<td>" . $red["ocjena"] . "</td>";
        $table .= "<td>" . $red["snaga"] . "</td>";
        $table .= "<td>" . $red["lokacija"] . "</td>";
        $table .= "<td><a class='gumb1' href='/WebDiP/2014_projekti/WebDiP2014x043/login/user/auto_detalji.php?id_auto=".$red['auto']."'>Vidi više</a></td>";
        $table .= "<tr>";
    }


    $table .= "</tbody>";
    echo $table;

    include_once("header/user_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}