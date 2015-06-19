<?php
session_start();
include_once("../pristup.php");
include_once("baza.class.php");
$baza = new Baza();


if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");

    if (isset($_POST["submit"])) {
        $sql = "INSERT INTO `sajam` (`id_sajam`, `lokacija`, `pocetak`, `kraj`, `aktivan`)
                VALUES (NULL, '" . $_POST['lokacija'] . "', '" . $_POST['pocetak'] . "', '" . $_POST['kraj'] . "','" . $_POST['aktivan'] . "')";
        $rezultat = $baza->ostaliUpiti($sql);
        echo "<small>Sajam je dodan</small>";
    }


    echo "<h3>Dodaj sajam</h3>";
    echo "<form action='' method='post'>
            Lokacija:<input placeholder='Lokacija' name='lokacija'>
            <br>
            Pocetak:<input placeholder='Početak' name='pocetak' id='datepicker'>
            <br>
            Kraj:<input placeholder='Kraj' name='kraj' id='datepicker1'>
            <br>
            Aktivan<input type='range' max='1'  name='aktivan'>
            <br>
            <input type='submit' value='Dodaj sajam' name='submit'>
        </form>";

    include_once("header/admin_footer.php");


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}