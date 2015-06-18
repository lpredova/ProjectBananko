<?php

class virtualnoVrijeme
{

    private  $datoteka;
    private  $citac;

    function __construct()
    {
        $this->datoteka = 'http://arka.foi.hr/WebDiP/pomak_vremena/pomak.xml';
        $this->citac = new XMLReader();
    }

    function vratiVrijeme()
    {
        $this->citac->open($this->datoteka);
        $pomak = 0;
        while ($this->citac->read()) {
            if ('pomak' === $this->citac->name) {
                $pomak = $this->citac->getAttribute('brojSati');
            }
        }
        return $pomak;
    }
}
