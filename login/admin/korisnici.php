<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");


    if(isset($_GET["otkljucaj"])){

        $sql="UPDATE `korisnik` SET `zakljucan` = '0' WHERE `korisnik`.`id_korisnik` =".$_GET["id"]." ;";
        $rezultat = $baza->ostaliUpiti($sql);
        echo "<small>Korisnik je otkljucan<small>";

    }




    echo "<h3>Korisnici</h3>";

    $sql = "select * from korisnik";
    $rezultat = $baza->selectDB($sql);

    $table = "<table id='korisnici'>
            <thead>
                <th>Ime</th>
                <th>Prezime</th>
                <th>email</th>
                <th>korisnicko ime</th>
                <th>Zakljucan</th>
                <th></th>
            </thead>
            <tbody>";

    while ($red = mysqli_fetch_array($rezultat)) {
        $table .= "<tr>";
        $table .= "<td>" . $red["ime"] . "</td>";
        $table .= "<td>" . $red["prezime"] . "</td>";
        $table .= "<td>" . $red["email"] . "</td>";
        $table .= "<td>" . $red["lozinka"] . "</td>";
        $table .= "<td>" . $red["zakljucan"] . "</td>";
        if($red["zakljucan"]==1){
            $table .= "<td><a class='gumb1' href='?otkljucaj=true&id=" . $red["id_korisnik"] . "'>Otključaj korisnika</a></td>";
        }
        $table .= "<tr>";
    }

    $table .= "</tbody>";
    echo $table;

    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}