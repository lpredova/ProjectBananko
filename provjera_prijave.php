<?php
include_once './baza.class.php';
include_once './korisnik.php';
include_once './sesija.php';

class prijava {
    public $Baza;
     
    public function __construct(){
        $this->Baza = new Baza();
        $this->Baza->spojiDB();
    }

    function provjeriLogin ($korIme, $lozinka){
        
        $sql = "SELECT id_korisnik, ime, prezime, email, korisnicko_ime, lozinka, tip_korisnika_id_tip_korisnika, status_korisnika_id_status_korisnika FROM korisnik WHERE Korisnicko_ime='$korIme'";
        $odgovor = $this->Baza->selectDB($sql);
        list($korId, $Ime, $Prezime, $korEmail, $korIme, $Lozinka, $Tip, $Status) = $odgovor->fetch_array();
        
        $korisnik = new Korisnik();
        $korisnik->PostaviPodatke($korId, $Ime, $Prezime, $korEmail, $korIme, $Lozinka, $Tip);
        if($korisnik->dohvati_id() < 1){
            $greske .= "Neispravno korisničko ime!";
        } else {
            if($korisnik->dohvati_lozinku() != $lozinka){
                $greske .= "Neispravna lozinka!";
            } else {
                $sesija = new Sesija();
                $sesija -> kreirajSesiju($korisnik->dohvati_id(), $korisnik->dohvati_ime(), $korisnik->dohvati_prezime(), $korisnik->dohvati_email(), $korisnik->dohvati_korisnicko_ime(), $korisnik->dohvati_tip());
                $sesija->kreirajKolac($korisnik->dohvati_ime());
                return $korisnik->dohvati_id();
            }
        }
    }
 
}

?>

