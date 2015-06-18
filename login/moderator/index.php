<?php
include_once("../pristup.php");

if(!loginMod() or !loginUser()){
    include_once("header/moderator_header.php");

}