<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");

$baza = new Baza();


if (loginUser() and !loginAdmin() and !loginMod()) {


    if (isset($_POST['submit'])) {
        $sql = "SELECT ocjena from automobil where id_automobil=" . $_GET["id_auto"] . ";";
        $rezultat = $baza->selectDB($sql);
        $broj = mysqli_fetch_assoc($rezultat);
        $nova_ocjena = (floatval($_POST["ocjena"]) + floatval($broj["ocjena"])) / 2;
        $sql_insert = "Update automobil set ocjena =" . $nova_ocjena . " where id_automobil=" . $_GET["id_auto"] . ";";
        $rezultat = $baza->ostaliUpiti($sql_insert);
        echo "<br><small>Ocjena automobila je ažurirana</small>";
    }

    if (isset($_POST['komentiraj'])) {
        $sql = "INSERT INTO komentari VALUES (DEFAULT, '" . $_POST['komentar'] . "', NOW()," . $_GET['id_auto'] . ");";
        $rezultat = $baza->selectDB($sql);
        echo "<br><small>Komentar je dodan</small>";
    }


    $poruka = "";
    $id_auto = "";

    include_once("header/user_header.php");
    echo "<h3>Detalji Auta</h3><br> $poruka";

    $sql = "select  * from automobil au
            where id_automobil=" . $_GET["id_auto"];


    $rezultat = $baza->selectDB($sql);


    $table = "
            <h4>Automobili na sajmu</h4>
            <table id='sajmovi'>
            <thead>
                <th>id</th>
                <th>Marka</th>
                <th>Godiste</th>
                <th>Kilometraza</th>
                <th>Snaga</th>
                <th>Potrošnja</th>
                <th>Tip goriva</th>
                <th>Dodatna oprema</th>
                <th>Ocjena</th>
            </thead>
            <tbody>";


    while ($red = mysqli_fetch_array($rezultat)) {
        $id_auto = $red["id_automobil"];
        $table .= "<tr>";
        $table .= "<td>" . $red["id_automobil"] . "</td>";
        $table .= "<td>" . $red["marka"] . "</td>";
        $table .= "<td>" . $red["godiste"] . "</td>";
        $table .= "<td>" . $red["kilometraza"] . "</td>";
        $table .= "<td>" . $red["snaga"] . "</td>";
        $table .= "<td>" . $red["potrosnja"] . "</td>";
        $table .= "<td>" . $red["tip_goriva"] . "</td>";
        $table .= "<td>" . $red["dodatna_oprema"] . "</td>";
        $table .= "<td>" . $red["ocjena"] . "</td>";
        $table .= "<tr>";
    }


    $forma = "
        <h4>Ocijeni automobil</h4>
        <form method='post' action=''>
        <input type='number' max='5' min='1' name='ocjena' required=''>
        <input type='hidden' name='id_auto'>
        <br>
        <input type='submit' name='submit' value='ocijeni auto' class='gumb1'>
        </form>
        <br>
        <br>
        <br>";

    $sql_slike = "select naziv_dokumenta as slika from galerija g join automobil a on a.id_automobil=g.automobil_id_automobil where a.id_automobil=" . $_GET['id_auto'] . ";";
    $rezultat_slika = $baza->selectDB($sql_slike);

    $slike = "";

    while ($red = mysqli_fetch_array($rezultat_slika)) {
        $slike .= "<img style='width:200px;height:200px' src='" . $red["slika"] . "' alt='slika'>";
        $slike .= "<br>";
    }

    $table .= "</tbody>";

    $komentari = "";
    $sql_komentari = "SELECT * FROM `komentari` WHERE automobil_id_automobil=" . $_GET['id_auto'];
    $rezultat_komentari = $baza->selectDB($sql_komentari);
    while ($red = mysqli_fetch_array($rezultat_komentari)) {
        $komentari .= "<p>" . $red["komentar"] . "</p>";
        $komentari .= "<small>" . $red["vrijeme_komentara"] . "</small>";
        $komentari .= "<hr>";
    }

    $komentari .= "<form method='post' action=''>
                <textarea name='komentar' rows='4' cols='50'></textarea>
                <input type='hidden' name='id_auto'>
                <br>
                <input type='submit' name='komentiraj' value='Komentiraj' class='gumb1'>
                </form>";

    echo $forma;
    echo $slike;
    echo $komentari;
    echo $table;

    include_once("header/user_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}