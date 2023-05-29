<?php
session_start();
//Seja poteče po 30 minutah - avtomatsko odjavi neaktivnega uporabnika
if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
    session_regenerate_id(true);
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<html>
<head>
    <title>Paketnik</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Paketnik</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <li><a class="nav-link" href="index.php">Domov</a></li>
            <?php
            if (isset($_SESSION["USER_ID"])){

            ?>
            <ul class="navbar-nav ms-auto">
                <li><a class="nav-link" href="index.php?controller=logs&action=zgodovina">Zgodovina</a></li>
                <li><a class="nav-link" href="index.php?controller=paketnik&action=dodajPaketnik">Dodaj</a></li>
                <li><a class="nav-link" href="index.php?controller=paketnik&action=zbrisiPaketnik">Izbrisi</a></li>
                <li><a class="nav-link" href="index.php?controller=paketnik&action=spremeniIme">Spremeni ime</a>
                <li><a class="nav-link" href="index.php?controller=paketnik&action=posodiKljuc">Posodi kljuc</a></li>
            </ul>
        </ul>
        <ul class="navbar-nav nav navbar-right">
            <li><a class="nav-link" href="index.php?controller=user&action=profil">Profil</a></li>
            <li><a class="nav-link" href="index.php?controller=user&action=odjava">Odjava</a></li>
        </ul>
        <?php
        } else {
            ?>
            </ul>
            <ul class="navbar-nav nav navbar-right">
                <li><a class="nav-link" href="index.php?controller=user&action=registracija">Registracija</a></li>
                <li><a class="nav-link" href="index.php?controller=user&action=prijava">Prijava</a></li>
            </ul>
            <?php
        }
        ?>
    </div>
</nav>
<hr/>