<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");


    echo "<h3>Korisnici</h3>";

    $sql = "select * from korisnik";
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='korisnici'>
            <thead>
                <th>Ime</th>
                <th>Prezime</th>
                <th>email</th>
                <th>korisnicko ime</th>
                <th>lozinka</th>
            </thead>
            <tbody>";

    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["ime"] . "</td>";
        $table .= "<td>" . $red["prezime"] . "</td>";
        $table .= "<td>" . $red["email"] . "</td>";
        $table .= "<td>" . $red["lozinka"] . "</td>";
        $table .= "<td><a class='gumb' href='/WebDiP/2014_projekti/WebDiP2014x043/login/admin/dodaj_moderatora.php?id=" . $red["id_sajam"] . "'>Otključaj korisnika</a></td>";
        $table .= "<tr>";
    }

    $table .= "</tbody>";
    echo $table;

    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}