<?php
	require_once('baza.class.php');
	$db = new baza('localhost','WebDiP2014x043','admin_d4zt','WebDiP2014x043');
	$db->connect();
	
	$xml = simplexml_load_file("pomak.xml");
	$trenutni = $xml->children()->children()->attributes()->brojSati;
	
	if(isset($_GET['id'])){
		$id = &_GET['id'];
		
		$novovrijeme = date('Y-m-d H:i:s');
		$starovrijeme = "select vrijeme from dnevnik_rada where korisnik_id_korisnik = '".$id."';";
		
		$result = $db->select($starovrijeme);
		
		while($red = $result->fetch_array()){
			$vrijeme = "{red[vrijeme]}";
		}
		if($trenutni > strotime($vrijeme)){
			header("Location: http://arka.foi.hr/WebDiP/2014_projekt/WebDiP2014x043/poruka.php?id=2");
		}
		else{
			$aktivacija = "UPDATE korisnik set status_korisnika_id_status_korisnika = 1 where id_korisnik = ".$id.";";
			$db->ostaliUpiti($aktivacija);
			header("Location: http://arka.foi.hr/WebDiP/2014_projekt/WebDiP2014x043/index.php");
		}
		
	}
	
	
?>