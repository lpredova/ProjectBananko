<?php
include_once './baza.class.php';
ob_start();
$baza = new Baza();
$greske = "";


if (isset($_POST['registracija'])) {

    //var_dump($_REQUEST);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $zupanija = $_POST['zupanija'];
    $grad = $_POST['grad'];
    $mail = $_POST['mail'];
    $korime = $_POST['korime'];
    $lozinka = $_POST['lozinka'];
    $telefon = $_POST['telefon'];
    $datum = $_POST['datum'];
    $spol = $_POST['spol'];
    $posta = $_POST['posta'];

    if ($ime === "") {
        $greske .= "Unesite vaše ime! <br>";
    }

    if ($prezime === "") {
        $greske .= "Unesite vaše prezime! <br>";
    }

    if ($adresa === "") {
        $greske .= "Unesite adresu! <br>";
    }

    if ($zupanija === "") {
        $greske .= "Unesite županiju! <br>";
    }

    if ($grad === "") {
        $greske .= "Unesite grad! <br>";
    }

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $greske .= "Netočno struktirirana email adresa! <br>";
    }

    if ($korime === "") {
        $greske .= "Unesite korisničko ime! <br>";
    }

    if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/", $lozinka)) {
        $greske .= "Lozinka ne zadovoljava format! <br>";
    }

    if ($telefon === "") {
        $greske .= "Unesite telefon! <br>";
    }

    if ($spol === "") {
        $greske .= "Odaberite spol! <br>";
    }

    if (!($ime{0} === strtoupper($ime{0})) || !($prezime{0} === strtoupper($prezime{0})) || !($grad{0} === strtoupper($grad{0}))) {
        $greske .= "Ime, prezime i grad moraju započeti velikim početnim slovom! <br>";
    }

    require_once('./recaptcha/recaptchalib.php');
    $privatekey = "6LfsRwYTAAAAAJhtQh8VjZ9V9JNnAlhjshdDjcj-";
    $resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        $greske .= "Unesite ono što vidite na slici!";
    }

    if (empty($greske)) {

        $upit = "select * from korisnik where korisnicko_ime = '$korime'";
        $rezultat = $baza->selectDB($upit);

        if ($rezultat->num_rows != 0) {
            $greske .= "Korisničko ime je već zauzeto! ";
        } else {
            $upit = "insert into korisnik (id_korisnik, ime, prezime, adresa, grad, zupanija, email, datum_rodenja, spol, korisnicko_ime, lozinka, tip_korisnika_id_tip_korisnika, status_korisnika_id_status_korisnika)
                     values (default, '$ime', '$prezime', '$adresa', '$grad', '$zupanija', '$mail', '$datum', '$spol', '$korime', '$lozinka', 3, 1)";
            echo $upit;
            $baza->ostaliUpiti($upit);
        }

    }
}
$skripta = basename($_SERVER['PHP_SELF']);
?>

<html>
<head>
    <title>Registracija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mmilutin.css"/>
    <link rel="stylesheet" type="text/css" href="css/mmilutin_mobitel.css" media="screen and (max-width: 450px)"/>
    <link rel="stylesheet" type="text/css" href="css/mmilutin_tablet.css"
          media="screen and (min-width: 451px) and (max-width: 800px)"/>
    <link rel="stylesheet" type="text/css" href="css/mmilutin_pc.css"
          media="screen and (min-width: 801px) and (max-width: 1000px)"/>
    <link rel="stylesheet" type="text/css" href="css/mmilutin_tv.css" media="screen and (min-width: 1001px)"/>
</head>
<body>
<header id="zaglavlje">
    Registracija
    <img class="zaglavlje" src="img/logo.png" alt="Logo FOI"/>
</header>
<nav id="navigacija">
    <ul>
        <li class="navigacija"><a class="navigacija1" href="prijava.php" target="_self">Stranica za prijavu</a></li>
        <li class="navigacija"><a class="navigacija1" href="registracija.php" target="_self">Stranica za
                registraciju</a></li>
        <li class="navigacija"><a class="navigacija1" href="index.php" target="_self">Početna stranica</a></li>
        <li class="navigacija"><a class="navigacija1" href="osobna.html" target="_self">Osobna stranica</a></li>
        <li class="navigacija"><a class="navigacija1" href="korisnici.html" target="_self">Stranica korisnika</a></li>
        <li class="navigacija"><a class="navigacija1" href="http://www.foi.unizg.hr/" target="_blank">FOI Početna</a>
        </li>
    </ul>
</nav>

<section id="sadrzaj">
    <div id="greske">
        <?php
        echo "$greske";
        ?>

    </div>
    <form name="registracija" action="<?php echo $skripta ?>" method="POST" enctype="multipart/form-data">

        <div>
            <label for="ime">Unesite svoje ime: </label>
            <input type="text" id="ime" name="ime" size="20" maxlength="30" placeholder="Ime"><br/>
        </div>

        <div>
            <label for="prezime">Unesite svoje prezime: </label>
            <input type="text" id="prezime" name="prezime" size="20" maxlength="50" placeholder="Prezime"><br/>
        </div>

        <div>
            <label for="adresa">Odaberite vašu adresu: </label>
            <textarea cols="25" name="adresa" id="adresa" rows="10" placeholder="Vaša kućna adresa"></textarea><br/>
        </div>

        <div>
            <label for="grad">Unesite grad: </label>
            <input type="text" id="grad" name="grad" size="20" maxlength="50" placeholder="Grad"><br/>
        </div>

        <div>
            <label for="zupanija">Odaberite Županiju: </label>
            <select name="zupanija" id="zupanija" required="">
                <option value="">-- Odaberite županiju --</option>
                <option value="Zagrebacka">-- Zagrebačka županija --</option>
                <option value="Krapinsko-zagorska">-- Krapinsko-zagorska županija --</option>
                <option value="Sisacko-moslavačka">-- Sisačko-moslavačka županija --</option>
                <option value="Karlovacka">-- Karlovačka županija --</option>
                <option value="Varazdinska" selected="">-- Varaždinska županija --</option>
                <option value="Koprivnicko-krizevacka">-- Koprivničko-križevačka županija --</option>
                <option value="Bjelovarsko-bilogorska">-- Bjelovarsko-bilogorska županija --</option>
                <option value="Primorsko-goranska">-- Primorsko-goranska županija --</option>
                <option value="Licko-senjska">-- Ličko-senjska županija --</option>
                <option value="Viroviticko-podravska">-- Virovitičko-podravska županija --</option>
                <option value="Pozesko-slavonska">-- Požeško-slavonska županija --</option>
                <option value="Brodsko-posavska">-- Brodsko-posavska županija --</option>
                <option value="Zadarska">-- Zadarska županija --</option>
                <option value="Osjecko-baranjska">-- Osječko-baranjska županija --</option>
                <option value="Sibensko-kninska">-- Šibensko-kninska županija --</option>
                <option value="Vukovarsko-srijemska">-- Vukovarsko-srijemska županija --</option>
                <option value="Splitsko-dalmatinska">-- Splitsko-dalmatinska županija --</option>
                <option value="Istarska">-- Istarska županija --</option>
                <option value="Dubrovacko-neretvanska">-- Dubrovačko-neretvanska županija --</option>
                <option value="Medimurska">-- Međimurska županija --</option>
                <option value="Grad Zagreb">-- Grad Zagreb --</option>
            </select>
        </div>

        <div>
            <label for="mail"> Unesite e-mail: </label>
            <input type="email" id="mail" name="mail" placeholder="korisnickoime@foi.hr"
                   title="Mail mora biti sa foi.hr domene!"><br/>
        </div>

        <div>
            <label for="korime"> Unesite korisničko ime: </label>
            <input type="text" id="korime" name="korime" pattern=".{5,}" placeholder="Korisničko ime"
                   title="Minimalno 5 znakova!"><br/>
        </div>

        <div>
            <label for="lozinka"> Unesite lozinku: </label>
            <input type="password" id="lozinka" name="lozinka" pattern=".{6,}" placeholder="Lozinka"
                   title="Minimalno 6 znakova!">
            <span id="zauzeto"></span><br/>

        </div>

        <div>
            <label for="telefon"> Unesite broj telefona: </label>
            <input type="tel" id="telefon" name="telefon" pattern="\d{3}[\ ]\d{7}" placeholder="xxx xxxxxxx"
                   title="npr. 096 5673425"><br/>
        </div>

        <div>
            <label for="datum"> Unesite datum rođenja: </label>
            <input type="date" id="datum" name="datum" title="DD.MM.GGGG."><br/>
        </div>

        <div>
            Odaberite spol:<br/>
            <label class="regSpol" for="spolm"> Muško</label>
            <input type="radio" id="spolm" name="spol" value="m"/>
            <label class="regSpol" for="spolz"> Žensko</label>
            <input type="radio" id="spolz" name="spol" value="z"/>
            <label class="regSpol" for="spolm"> Nepoznato</label>
            <input type="radio" id="spoln" name="spol" value="n"/><br/>
        </div>

        <div>
            <label class="regPošta" for="posta">Želite li primati obavijesti o našem sustavu putem e-maila? </label>
            <input type="checkbox" value="posta" id="posta" name="posta"/><br/>
        </div>

        <?php
        require_once('./recaptcha/recaptchalib.php');
        $publickey = "6LfsRwYTAAAAAJ6cJRRKiUG9CIwCVV_eLQFSRYPz";
        echo recaptcha_get_html($publickey);
        ?>
        <input name="registracija" class="gumb" type="submit" value="Registriraj se"/>
        <input class="gumb" type="reset">


    </form>

</section>

<footer>
    <address>
        Mario Milutin <br/>
        <a href="mailto:mmilutin@foi.hr">Pošaljite mi mail</a>

        <p><a href="http://validator.w3.org/check/referer">
                <img src="http://www.rajtechnologies.com/images/html5-logo.png" alt="Valid HTML5!"/>
            </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"/>
            </a>
        </p>
    </address>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/registracija.js"></script>
</footer>
</body>
</html>

