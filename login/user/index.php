<?php
include_once("../pristup.php");


if (loginUser() and !loginAdmin() and !loginMod()) {

    include_once("header/user_header.php");
    echo "<h3>Dobro došli !</h3>";

    include_once("header/user_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}