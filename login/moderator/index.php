<?php
include_once("../pristup.php");

if(loginMod() and !loginUser() and !loginAdmin()){
    include_once("header/moderator_header.php");

} else {
    header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/403.html");
}