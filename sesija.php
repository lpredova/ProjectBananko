<?php
class Sesija {
    const SESSION_NAME = "idSesija";
    const ID = "ID";
    const IME = "IME";
    const PREZIME = "PREZIME";
    const EMAIL = "EMAIL";
    const KORIME = "KORIME";
    const TIP = "TIP";
    
    function kreirajSesiju ($idKorisnika, $imeKorisnika, $prezimeKorisnika, $emailKorisnika, $korIme, $Tip){
        session_name(self::SESSION_NAME);
        if(session_id() == ""){
            session_start();
        }
        $_SESSION[self::ID] = $idKorisnika;
        $_SESSION[self::KORIME] = $imeKorisnika;
        $_SESSION[self::PREZIME] = $prezimeKorisnika;
        $_SESSION[self::EMAIL] = $emailKorisnika;
        $_SESSION[self::KORIME] = $korIme;
        $_SESSION[self::TIP] = $Tip;
    }
    
    function provjeriSesiju (){
            session_name(self::SESSION_NAME);
            if(session_id() == ""){
                session_start();
            }
            if (isset($_SESSION[self::ID])){
                $id = $_SESSION[self::ID];
            } else {
                return null;
            }
            return $id;
        }
    function dohvatiUlogu(){
        session_name(self::SESSION_NAME);
        if(session_id() == ""){
            session_start();
        }
        if(isset($_SESSION[self::TIP])){
            $tip = $_SESSION[self::TIP];
        } else {
            return 0;
        }
        return $tip;
    }
 
    function brisiSesiju (){
        session_name(self::SESSION_NAME);
        if(session_id() == ""){
            session_start();
        }
        session_destroy();
    }

    function kreirajKolac ($korIme){
         
    }
    function brisiKolac ($korIme){
        setcookie("korisnik", "", time()-1800);
    }
}
?>