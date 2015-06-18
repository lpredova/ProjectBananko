<?php
session_start();
include_once("../pristup.php");
include_once("virtualno_vrijeme.php");

function procitajPomak()
{
    $f = fopen("vrijeme.txt", 'r');
    $pomak = fgets($f);
    fclose($f);
    return intval($pomak);
}

if (loginAdmin()) {
    include_once("header/admin_header.php");
    if (isset($_GET["preuzmi_vrijeme"])) {

        $url = 'http://arka.foi.hr/WebDiP/pomak_vremena/pomak.xml';
        $xml = simplexml_load_file($url);

        print_r($xml);
        $pomak = $xml->vrijeme[0]->pomak->brojSati;
        echo $pomak;
        file_put_contents("vrijeme.txt", $pomak);
        echo "<h1>Virtualno vrijeme je preuzeto</h1>";
    }

    echo "<h3>Virtualno vrijeme</h3>";
    echo "<p>Trenutno vrijeme aplikacije je " . $date = date('H:i:s', time() + 60 * 60 * procitajPomak()) . "</p>";
    echo "<p>Pravo vrijeme je" . $date = date('H:i:s', time()) . "</p>";
    echo "<a href='?preuzmi_vrijeme=true'>Preuzmi virtualno vrijeme</a>";


} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}