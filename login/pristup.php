<?php


function loginAdmin()
{
    session_start();
    if ($_SESSION["TIP"] == 1) {
        return true;
    } else {
        return false;
    }
}

function loginMod()
{
    session_start();
    if ($_SESSION["TIP"] == 2) {
        return true;
    } else {

        return false;
    }
}

function loginUser()
{
    session_start();
    if ($_SESSION["TIP"] == 3) {
        return true;
    } else {
        return false;
    }
}

function logged()
{
    session_start();
    if (isset($_SESSION["TIP"])) {
        return true;
    } else {
        return false;
    }

}