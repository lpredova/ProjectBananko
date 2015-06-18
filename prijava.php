<?php
ob_start();
session_start();

include_once './provjera_prijave.php';
include_once './baza.class.php';
include_once './sesija.php';

if (isset($_POST["korIme"])) {
    $korIme = $_POST["korIme"];
    $lozinka = $_POST["lozinka"];

    $prijava = new prijava();
    $ID = $prijava->provjeriLogin($korIme, $lozinka);
    if ($ID > 0) {
        $sql = "INSERT INTO dnevnik_rada (id_dnevnik_rada, radnja, vrijeme, korisnik_id_korisnik) VALUES (DEFAULT, 'Prijava', NOW(), '$ID')";
        $prijava->Baza->ostaliUpiti($sql);
    }

    if ($_SESSION["TIP"] == 1) {
        header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/admin/index.php");
        exit();
    } elseif ($_SESSION["TIP"] == 2) {
        header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/moderator/index.php");
        exit();

    } elseif ($_SESSION["TIP"] == 3) {
        header("Location:/WebDiP/2014_projekti/WebDiP2014x043/login/user/index.php");
        exit();
    }
}

$skripta = basename($_SERVER['PHP_SELF']);
?>

<?php
$naslov = 'Prijava';
include './_header.php';
?>

    <div id="greske">
        <?php
        echo "$greske";
        ?>

    </div>

    <form name="prijava" action="<?php echo $skripta ?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="korIme">Korisničko ime</label>
            <input type="text" name="korIme" id="korIme" placeholder="Korisničko ime" size="20" maxlength="50"
                   required="required"><br/>
        </div>
        <div>
            <label for="lozinka">Lozinka</label>
            <input type="password" name="lozinka" id="lozinka" placeholder="Lozinka" size="10" maxlength="15"
                   required="required"><br/>
        </div>

        <div>
            <label for="zapamti" id="lblZapamti">Zapamti me</label>
            <input type="checkbox" id="zapamti" name="zapamti" value="1"><br/>
        </div>

        <input type="submit" id="posalji" value="Prijavi se" class="gumb">
    </form>


<?php
include './_footer.php';
?>