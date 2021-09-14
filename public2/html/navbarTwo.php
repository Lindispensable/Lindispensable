<?php session_start(); 

    $profil = 'CONNEXION';
    $profilLien = '/connexion.php';

    if(isset($_SESSION['email'])) { 
      
        $profil = 'PROFIL';
        $profilLien = '/profil.php';
                            
    }
    else {
        $profil = 'CONNEXION';
        $profilLien = '/connexion.php';
    }

?>

<!-- Menu de Navigation N°2 -->
<div class="header__navbar">
    <div class="header__register--menu">
        <a href="<?= $profilLien ?>" class="header__register--menu-link"><?= $profil ?></a>
    </div>
    <a href="" class="header__navbar--title">L'Indispensable</a>
    <div class="header__navbar--menu">
        <a href="/index.php" class="header__navbar--menu-link">Accueil</a>
        <a href="/utilisateurs.php" class="header__navbar--menu-link2">Utilisateurs</a>
        <a href="/carte.php" class="header__navbar--menu-link2">Carte</a>

        <a href="" class="header__navbar--menu-link2">PAGE4</a>
        <a href="" class="header__navbar--menu-link2">PAGE5</a>
        <a href="" class="header__navbar--menu-link2">PAGE6</a>
    </div>
    <div class="header__navbar--toggle">
        <span class="header__navbar--toggle-icons"></span>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="/public2/js/app.js"></script>