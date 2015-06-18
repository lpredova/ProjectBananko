<?php
session_start();
include_once("../pristup.php");

if(loginAdmin()){
    include_once("header/admin_header.php");

    var_dump($_SESSION);

}
else{
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");

}