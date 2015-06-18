<?php
	session_start();
	
	if(isset($GET['id'])){
		if = $_GET['id'];
		$poruka = "";
		
		switch($id){
			case 1: $poruka="Na vasu mail adresu poslana je kod kojim trebate potvrditi registraciju";break;
			case 2: $poruka = "Istekao je rok za prijavu";
		}
		
		
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ispis poruke</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<section>
			<?php
			echo $poruka;
			?>
		</section>
	</body>
	
	

</html>