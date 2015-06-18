<?php
session_start();
?>

<html>
<head>
    <?php
    echo "<title>$naslov</title>";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header id="zaglavlje">
    <img class="zaglavlje" src="/img/logo.png" alt="Logo FOI"/>
</header>
<nav id="navigacija">
    <ul>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/index.php" target="_self">Glavna stranica</a></li>
        <li class="navigacija"><a href="registracija.php" target="_self">Stranica za registraciju</a></li>
        <li class="navigacija"><a href="index.php" target="_self">Početna stranica</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/virtualno_vrijeme_panel.php">Virtualno vrijeme</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/logout.php">Odjava</a></li>

        <li>Dobro došao <?php
            echo $_SESSION["KORIME"];
            echo $_SESSION["PREZIME"];
            ?></li>

    </ul>
</nav>


