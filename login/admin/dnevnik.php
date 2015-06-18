<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");

    echo "<h3>Sajmovi</h3>";

    $sql = "select d.id_dnevnik_rada as id,d.radnja,d.vrijeme,k.korisnicko_ime as korisnik from dnevnik_rada d join korisnik k on k.id_korisnik=d.korisnik_id_korisnik";
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='dnevnik'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Radnja</th>
                    <th>Vrijeme</th>
                    <th>Korisnik</th>
                </tr>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["id"] . "</td>";
        $table .= "<td>" . $red["radnja"] . "</td>";
        $table .= "<td>" . $red["vrijeme"] . "</td>";
        $table .= "<td>" . $red["korisnik"] . "</td>";
        $table .= "<tr>";
    }

    $table .= "</tbody>";

    echo $table;

    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}