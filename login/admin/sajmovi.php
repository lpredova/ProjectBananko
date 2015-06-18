<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");


    echo "<h3>Sajmovi</h3>";

    $sql = "select * from sajam";
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='sajmovi'>
            <thead>
                <th>ID_sajam</th>
                <th>Lokacija</th>
                <th>Pocetak</th>
                <th>Kraj</th>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["id_sajam"] . "</td>";
        $table .= "<td>" . $red["lokacija"] . "</td>";
        $table .= "<td>" . $red["pocetak"] . "</td>";
        $table .= "<td>" . $red["kraj"] . "</td>";
        $table .= "<td>" . $red["aktivan"] . "</td>";
        $table .= "<td><a class='gumb' href='/WebDiP/2014_projekti/WebDiP2014x043/login/admin/dodaj_moderatora.php?id=" . $red["id_sajam"] . "'>Dodaj moderatora</a></td>";
        $table .= "<tr>";
    }

    echo "<a href='/WebDiP/2014_projekti/WebDiP2014x043/login/admin/dodaj_sajam.php' class='gumb'>Dodaj sajam</a>";

    $table .= "</tbody>";
    echo $table;

    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}