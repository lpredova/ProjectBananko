<?php
require_once('baza.class.php');
session_start();

if(!isset($_SESSION['id'])){
	header ("Location: http://arka.foi.hr/WebDiP/2014_projekti/WebDiP2014x043/index.php");
	
}
if(($_SESSION['Tip']!=1){
	header ("Location: http://arka.foi.hr/WebDiP/2014_projekti/WebDiP2014x043/index.php");
}

else{
	$db = new baza();
	if(isset($_GET['id'])){
		$id_korisnika = $_GET['id'];
		$query = "select tip_korisnika_id_tip_korisnika from korisnik where id_korisnik = ".$id_korisnika;
		$rezultat = $db->select($query);
		while($red = $rezultat->fetch_array()){
			$broj = "{$red[]}";
		}
		if($broj==3){
			$query= "update korisnik set tip_korisnika_id_tip_korisnika = null where id_korisnik = ".$id_korisnika;
			$db->query($query);
			header("Location: http://arka.foi.hr/WebDiP/2014_projekti/WebDiP2014x043/index.php");
		}
		else{
			$query = "update korisnik set tip_korisnika_id_tip_korisnika = 3 where id_korisnik = ".$id_korisnika;
			$db->query($query);
			header("Location: http://arka.foi.hr/WebDiP/2014_projekti/WebDiP2014x043/index.php");
		}
	}
}

