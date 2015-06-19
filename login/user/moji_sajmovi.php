<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");

$baza = new Baza();


if (loginUser() and !loginAdmin() and !loginMod()) {

    $poruka = "";


    include_once("header/user_header.php");
    echo "<h3>Sajmovi</h3><br> $poruka";

    $sql = "select s.id_sajam,s.lokacija,s.pocetak,s.kraj from sajam s join sajam_has_korisnik shk on s.id_sajam=shk.sajam_id_sajam where shk.korisnik_id_korisnik=".$_SESSION["ID"];
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='sajmovi'>
            <thead>
                <th>ID_sajam</th>
                <th>Lokacija</th>
                <th>Pocetak</th>
                <th>Kraj</th>
                <th>Akcija</th>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["id_sajam"] . "</td>";
        $table .= "<td>" . $red["lokacija"] . "</td>";
        $table .= "<td>" . $red["pocetak"] . "</td>";
        $table .= "<td>" . $red["kraj"] . "</td>";
        $table .= "<td><a class='gumb1' href='/WebDiP/2014_projekti/WebDiP2014x043/login/user/sajam_detalji.php?id_sajam=" . $red["id_sajam"] . "'>Vidi detalje</a></td>";
        $table .= "<tr>";
    }


    $table .= "</tbody>";
    echo $table;

    include_once("header/user_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}