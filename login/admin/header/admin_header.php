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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="/WebDiP/2014_projekti/WebDiP2014x043/css/admin_stil.css"/>

</head>
<body>
<nav id="admin-navigacija">
    <ul>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/index.php" target="_self">Glavna stranica</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/sajmovi.php" target="_self">Sajmovi</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/dnevnik.php" target="_self">Dnevnik rada</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/virtualno_vrijeme_panel.php">Virtualno vrijeme</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/admin/korisnici.php">Korisnici</a></li>
        <li class="navigacija"><a href="/WebDiP/2014_projekti/WebDiP2014x043/login/logout.php">Odjava</a></li>

        <li>Dobro došao <?php
            echo $_SESSION["KORIME"];
            echo $_SESSION["PREZIME"];
            ?></li>

    </ul>
</nav>


