<?php
include_once '../baza.class.php';
$baza = new Baza();

//sajmovi
if (isset($_POST["sajmovi"])) {

    $sql = "select * from sajmovi";
    $rezultat = $baza->selectDB($upit);

    echo json_encode($rezultat);


}