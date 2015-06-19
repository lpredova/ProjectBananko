<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");

$baza = new Baza();


if (loginUser() and !loginAdmin() and !loginMod()) {

    $poruka = "";

    if (isset($_GET["sajmovi"])) {

        $sql = "INSERT INTO `sajam_has_korisnik` (`sajam_id_sajam`, `korisnik_id_korisnik`) VALUES ('" . $_GET['id_sajam'] . "', '" . $_SESSION['ID'] . "');";
        $rezultat = $baza->ostaliUpiti($sql);

        $poruka .= "<small>Korisnik" . $_SESSION['KORIME'] . "se prijavio na sajam</small>";
    }


    include_once("header/user_header.php");
    echo "<h3>Sajmovi</h3><br> $poruka";

    $sql = "select * from sajam";
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='sajmovi'>
            <thead>
                <th>ID_sajam</th>
                <th>Lokacija</th>
                <th>Pocetak</th>
                <th>Kraj</th>
                <th>Aktivan</th>
                <th>Akcija</th>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["id_sajam"] . "</td>";
        $table .= "<td>" . $red["lokacija"] . "</td>";
        $table .= "<td>" . $red["pocetak"] . "</td>";
        $table .= "<td>" . $red["kraj"] . "</td>";
        $table .= "<td>" . $red["aktivan"] . "</td>";
        $table .= "<td><a class='gumb1' href='/WebDiP/2014_projekti/WebDiP2014x043/login/user/sajmovi.php?sajmovi=true&id_sajam=" . $red["id_sajam"] . "'>Prijavi me</a></td>";
        $table .= "<tr>";
    }


    $table .= "</tbody>";
    echo $table;

    include_once("header/user_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}