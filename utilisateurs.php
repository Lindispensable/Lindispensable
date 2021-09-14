<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>L'Indispensable</title>
        <link rel="stylesheet" href="public2/css/base.css">
        <link rel="stylesheet" href="public2/css/header.css">
        <link rel="stylesheet" href="public2/css/utilisateurs.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="page">
            <div class="container">
                
                <?php include 'navbar.php'; ?>

                <?php
                    include 'database.php';
                    global $db;
                ?>   

                <div class="utilisateurs">
                    <p class="utilisateurs__title">UTILISATEURS</p>
                    <?php
                    $q = $db->query("SELECT * FROM users");
                    while ($user = $q->fetch()) {?>
                        <p class="utilisateurs__info">Pseudo : <?php echo $user['pseudo']; ?></p>
                    <?php  }?>
                </div>
                
                <h1>Info Connexion :</h1>
                <?php 

                    if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])) { 
                        echo "<p class='test'>Votre pseudo : " . $_SESSION['pseudo'] . "</p>";
                        echo "<p>Votre e-mail : " . $_SESSION['email'] . "</p>";
                        
                    }
                    else {
                        echo "<p>Connecter vous à votre compte</p>";
                    }

                ?>

            </div>
        </div>

        
    
    
    </body>
</html>