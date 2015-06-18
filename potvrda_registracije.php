<?php
//vrijeme.txt
	require_once('baza.class.php');
	$db = new baza('localhost','WebDiP2014x043','admin_d4zt','WebDiP2014x043');
	$db->spojiDB();
	
	if(isset($_GET['id'])){
		$korisnik = $_GET['id'];
		
		$novovrijeme = date('Y-m-d H:i:s');
		
		$_fp = fopen("vrijeme.txt", "r");
		fscanf($_fp, "%d\n", $count);
		$numbers = explode(" ", trim(fgets($_fp)));
		foreach ($numbers as &$number)
		{
			$number = intval($number);
		}
		sort($numbers);
		$pomak = $numbers;
		
		$starovrijeme = "select vrijeme from dnevnik_rada where korisnik = '".$korisnik."';";
		
		$result = $db->select($starovrijeme);
		
		while($red = $result->fetch_array()){
			$vrijeme = "{red[vrijeme]}";
		}
		if($pomak > strotime($vrijeme)){
			header("Location: http://arka.foi.hr/WebDiP/2014_projekt/WebDiP2014x043/poruka.php?id=2");
		}
		else{
			$aktivacija = "UPDATE korisnik set status_korisnika_id_status_korisnika = 1 where id_korisnik = ".$korisnik.";";
			$db->ostaliUpiti($aktivacija);
			header("Location: http://arka.foi.hr/WebDiP/2014_projekt/WebDiP2014x043/index.php");
		}
		
	}
	
	
?>