<html>
<head>
        <?php
        echo "<title>$naslov</title>";
        ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/mmilutin.css" />
<link rel="stylesheet" type="text/css" href="css/mmilutin_mobitel.css" media="screen and (max-width: 450px)" />
<link rel="stylesheet" type="text/css" href="css/mmilutin_tablet.css" media="screen and (min-width: 451px) and (max-width: 800px)" />
<link rel="stylesheet" type="text/css" href="css/mmilutin_pc.css" media="screen and (min-width: 801px) and (max-width: 1000px)" />
<link rel="stylesheet" type="text/css" href="css/mmilutin_tv.css" media="screen and (min-width: 1001px)" />
</head>
<body>
<header id="zaglavlje">
    <?php
    session_start();
    echo "<h1>A".$_SESSION["KORIME"]."</h1>";
    ?>
    <img class="zaglavlje" src="img/logo.png" alt="Logo FOI" />
</header>
<nav id="navigacija">
    <ul>
        <li class="navigacija"><a href ="prijava.php" target="_self">Stranica za prijavu</a></li>
        <li class="navigacija"><a href ="registracija.php" target="_self">Stranica za registraciju</a></li>
        <li class="navigacija"><a href ="index.php" target="_self">Početna stranica</a></li>
        <li class="navigacija"><a href ="osobna.html" target="_self">Osobna stranica</a></li>
        <li class="navigacija"><a href ="/WebDiP/2014_projekti/WebDiP2014x043/login/logout.php">Odjava</a></li>
    </ul>
</nav>


