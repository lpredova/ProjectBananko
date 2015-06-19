<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Baza
{

    /*const server = "localhost";
    const baza = "WebDiP2014x043";
    const korisnik = "WebDiP2014x043";
    const lozinka = "admin_d4zt";*/
    const server = "localhost";
    const baza = "WebDiP2014x043";
    const korisnik = "root";
    const lozinka = "mysql";

    public function spojiDB()
    {
        $mysqli = new mysqli(self::server, self::korisnik, self::lozinka, self::baza);
        $mysqli->set_charset("utf8");

        if ($mysqli->connecti_errno) {
            echo "Neuspješno spajanje na bazu: " . $mysqli->connect_erno . ", " . $mysqli->connect_error;
        }
        return $mysqli;
    }

    function selectDB($upit)
    {
        $veza = self::spojiDB();
        $rezultat = $veza->query($upit) or trigger_error("Greška kod upita: {$upit} -
            Greška: " . $veza->error . " " . E_USER_ERROR);

        if (!$rezultat) {
            $rezultat = null;
        }

        $veza->close();
        return $rezultat;
    }

    function prekiniVezu()
    {
        $veza = self::spojiDB();
        if (mysqli_close($veza)) {
        } else {
            echo "Neuspješno zatvaranje veze prema bazi!";
        }
    }

    function ostaliUpiti($upit)
    {
        $veza = self::spojiDB();
        if ($rezultat = $veza->query($upit)) {
            self::prekiniVezu();
        } else {
            echo "Došlo je do pogreške!";
        }
    }

}