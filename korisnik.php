<?php

class Korisnik {
    private $id;
    private $ime;
    private $prezime;
    private $email;
    private $korIme;
    private $lozinka;
    private $tip;
    private $status = 0;

    function PostaviPodatke ($idKorisnika, $imeKorisnika, $prezimeKorisnika, $emailKorisnika, $korIme, $lozinkaKorisnika, $UlogaKorisnika){
        $this->id = $idKorisnika;
        $this->ime = $imeKorisnika;
        $this->prezime = $prezimeKorisnika;
        $this->email = $emailKorisnika;
        $this->korIme = $korIme;
        $this->lozinka = $lozinkaKorisnika;
        $this->tip = $UlogaKorisnika;
        $this->status = 1;
    }
    function dohvati_id (){
        return $this->id;
    }
    function dohvati_korisnicko_ime (){
        return $this->korIme;
    }
    function dohvati_lozinku (){
        return $this->lozinka;
    }
    function dohvati_tip (){
        return $this->tip;
    }
    function dohvati_ime (){
        return $this->ime;
    }
    function dohvati_prezime (){
        return $this->prezime;
    }
    function dohvati_email (){
        return $this->email;
    }
}
?>