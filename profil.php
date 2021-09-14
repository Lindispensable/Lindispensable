<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>L'Indispensable</title>
        <link rel="stylesheet" href="public2/css/base.css">
        <link rel="stylesheet" href="public2/css/header.css">
        <link rel="stylesheet" href="public2/css/profil.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="page">
            <div class="container">

                <?php include 'navbar.php'; ?>

                <div class="profil__container">
                
                    

                    <?php
                        include 'database.php';
                        global $db;
                    ?>   

                    <?php
                        echo "<p class='title'>Information de votre compte</p>";
                        echo "<p class='para'>Pseudo : " . $_SESSION['pseudo'] . "</p></br>";
                        echo "<p class='para'>E-mail : " . $_SESSION['email'] . "</p></br>";
                        echo "<p class='para'>Date de création : " . $_SESSION['date'] . "</p></br>";
                    ?>

                    <form action="" method="post">
                        <input class="profil__button" type="submit" name="dformsend" placeholder="Deconnexion" value="Déconnexion" require>
                    </form>

                    <?php

                        if(isset($_POST['dformsend'])) {
                            
                            session_unset();
                            session_destroy();
                            header('Refresh: 1; url=connexion.php');

                        }

                    ?>

                </div>
            </div>
        </div>

        
    
    
    </body>
</html>