<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");

    if (isset($_POST["submit"])) {
        $sql = "INSERT INTO `sajam_has_korisnik` (`sajam_id_sajam`, `korisnik_id_korisnik`) VALUES ('" . $_POST['id_sajam'] . "', '" . $_POST['moderator'] . "');";

        $rezultat = $baza->ostaliUpiti($sql);
        echo "<h3>Korisnik je dodan</h3>";
    }


    $sql1 = "select id_korisnik,korisnicko_ime from korisnik where tip_korisnika_id_tip_korisnika = 2";
    $rezultat_1 = $baza->selectDB($sql1);

    $select = "";
    while ($red = mysqli_fetch_array($rezultat_1)) {
        $select .= "<option value='" . $red['id_korisnik'] . "'>" . $red['korisnicko_ime'] . "</option>";
    }


    echo "<h3>Dodaj moderatora sajmu </h3>";

    echo "
            <br>
            <br>
            <br>
            <form action='' method='post' class='center'>
            <input type='hidden' name='id_sajam' value='" . $_GET['id'] . "'>
            <select name='moderator'>
            $select
            </select>
            <br>
            <br>
            <br>
            <input type='submit' value='Dodaj moderatora' name='submit' class='gumb'>
        </form>";


    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}