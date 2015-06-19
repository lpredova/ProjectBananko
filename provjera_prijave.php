<?php
include_once './baza.class.php';
include_once './korisnik.php';
include_once './sesija.php';
session_start();

class prijava
{

    private $neuspjesni = 0;
    private $kor_id;
    public $Baza;

    public function __construct()
    {
        $this->Baza = new Baza();
        $this->Baza->spojiDB();
    }

    function provjeriLogin($korIme, $lozinka)
    {

        $sql = "SELECT id_korisnik, ime, prezime, email, korisnicko_ime, lozinka, tip_korisnika_id_tip_korisnika, status_korisnika_id_status_korisnika FROM korisnik WHERE Korisnicko_ime='$korIme' and zakljucan=0";
        $odgovor = $this->Baza->selectDB($sql);
        list($korId, $Ime, $Prezime, $korEmail, $korIme, $Lozinka, $Tip, $Status) = $odgovor->fetch_array();

        $korisnik = new Korisnik();
        $korisnik->PostaviPodatke($korId, $Ime, $Prezime, $korEmail, $korIme, $Lozinka, $Tip);


        if ($_SESSION["pokusaj"] >= 3) {
            $sql = "UPDATE `korisnik` SET `zakljucan` = '1' WHERE `korisnik`.`id_korisnik` = " . $_SESSION["pokusaj_kor"] . ";";
            $this->Baza->ostaliUpiti($sql);
            header("Location:/WebDiP/2014_projekti/WebDiP2014x043/locked.html");
            $_SESSION["pokusaj"] = 0;
            exit();
        }

        if ($korisnik->dohvati_id() < 1) {
            $greske .= "Neispravno korisničko ime!";
        } else {
            if ($korisnik->dohvati_lozinku() != $lozinka) {
                $greske .= "Neispravna lozinka!";
                $_SESSION["pokusaj"] += 1;
                $_SESSION["pokusaj_kor"] = $korisnik->dohvati_id();


            } else {
                $sesija = new Sesija();
                $sesija->kreirajSesiju($korisnik->dohvati_id(), $korisnik->dohvati_ime(), $korisnik->dohvati_prezime(),
                    $korisnik->dohvati_email(), $korisnik->dohvati_korisnicko_ime(), $korisnik->dohvati_tip());
                $sesija->kreirajKolac($korisnik->dohvati_ime());
                return $korisnik->dohvati_id();
            }
        }
    }


}

?>

