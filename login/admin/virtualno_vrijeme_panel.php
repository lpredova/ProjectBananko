<?php
session_start();
include_once("../pristup.php");

function procitajPomak()
{
    $f = fopen("vrijeme.txt", 'r');
    $pomak = fgets($f);
    fclose($f);
    return intval($pomak);
}

if (loginAdmin() and !loginMod() and !loginMod()) {
    include_once("header/admin_header.php");
    if (isset($_GET["preuzmi_vrijeme"])) {

        $url = 'http://arka.foi.hr/WebDiP/pomak_vremena/pomak.xml';
        $xml = simplexml_load_file($url);
        $pomak = $xml->vrijeme[0]->pomak->brojSati;
        file_put_contents("vrijeme.txt", $pomak);
        echo "<h1>Virtualno vrijeme je preuzeto</h1>";
    }

    echo "<div class='center'><h3>Virtualno vrijeme</h3>";
    echo "<p>Trenutno vrijeme aplikacije je <b>" . $date = date('H:i:s', time() + 60 * 60 * procitajPomak()) . "</b></p>";
    echo "<p>Pravo vrijeme je:   <b>" . $date = date('H:i:s', time()) . "</b></p>";
    echo "<a href='?preuzmi_vrijeme=true' class='gumb1'>Preuzmi virtualno vrijeme</a></div>";

    include_once("header/admin_footer.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}