<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>L'Indispensable</title>
        <link rel="stylesheet" href="public2/css/base-inscription.css">
        <link rel="stylesheet" href="public2/css/header.css">
        <link rel="stylesheet" href="public2/css/connexion.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="page">
            <div class="container">
                
                <?php include 'navbar.php'; ?>

                <div class="ins">
                    <div class="ins__container">
                        <form class="ins__menu" action="" method="post">
                            <h1 class="ins__menu--title">INSCRIPTION</h1>
                            <input class="ins__menu--pseudo" type="text" name="pseudo" placeholder="Pseudo" require>
                            <input class="ins__menu--mail" type="text" name="email" placeholder="Adresse E-mail" require>
                            <input class="ins__menu--tel" type="text" name="Telephone" placeholder="Numéro de téléphone" require>
                            <input class="ins__menu--mdp" type="password" name="password" placeholder="Mot de passe" require>
                            <input class="ins__menu--mdp" type="password" name="cpassword" placeholder="Confirmer votre mot de passe" require>
                            <input class="ins__menu--button" type="submit" name="formsend" placeholder="Inscription">
                        </form>
                    </div>

                    <div class="con__container">
                        <form class="con__menu" action="" method="post">
                            <h1 class="con__menu--title">CONNEXION</h1>
                            <input class="con__menu--mail" type="text" name="lemail" placeholder="Adresse E-mail" require>
                            <input class="con__menu--mdp" type="password" name="lpassword" placeholder="Mot de passe" require>
                            <input class="con__menu--button" type="submit" name="lformsend" placeholder="Connexion" require>
                        </form>
                    </div>
                </div>
                
                <?php
                    include 'database.php';
                    global $db;
                    
                    
                    //INSCRIPTION

                    if(isset($_POST['formsend'])) {
                        
                        $pseudo = $_POST['pseudo'];
                        $email = $_POST['email'];
                        $Telephone = $_POST['Telephone'];
                        $password = $_POST['password'];
                        $cpassword = $_POST['cpassword'];
                        
                        if(!empty($pseudo) && !empty($email) && !empty($Telephone) && !empty($password) && !empty($cpassword)) {

                            if($password == $cpassword) {

                                $options = ['cost' => 12];
                                $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
                                $hashCPassword = password_hash($cpassword, PASSWORD_BCRYPT, $options);

                                

                                $existPseudo = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                                $existPseudo->execute(['pseudo' => $pseudo]);
                                $resultPseudo = $existPseudo->rowCount();
                                
                                $existEmail = $db->prepare("SELECT email FROM users WHERE email = :email");
                                $existEmail->execute(['email' => $email]);
                                $resultEmail = $existEmail->rowCount();
                                
                                $existTelephone = $db->prepare("SELECT Telephone FROM users WHERE Telephone = :Telephone");
                                $existTelephone->execute(['Telephone' => $Telephone]);
                                $resultTelephone = $existTelephone->rowCount();
                                
                                $existPassword = $db->prepare("SELECT password FROM users WHERE password = :password");
                                $existPassword->execute(['password' => $password]);
                                $resultPassword = $existPassword->rowCount();

                                if($resultPseudo == 0 && $resultEmail == 0 && $resultTelephone == 0 && $resultPassword == 0) {
                                    $q = $db->prepare("INSERT INTO users(pseudo,email,Telephone,password) VALUES(:pseudo,:email,:Telephone,:password)");
                                    $q->execute([
                                        'pseudo' => $pseudo,
                                        'email' => $email,
                                        'Telephone' => $Telephone,
                                        'password' => $hashPassword
                                    ]);
                                    echo "Votre compte a été créée";
                                }
                                elseif ($resultPseudo > 0) {
                                    echo "Erreur lors de la crétion du compte, le pseudo : " . $pseudo . " existe déjà";
                                }

                                elseif ($resultEmail > 0) {
                                    echo "Erreur lors de la crétion du compte, l'email : " . $email . " existe déjà";
                                }
                                
                                elseif ($resultTelephone > 0) {
                                    echo "Erreur lors de la crétion du compte, le numéro de telephone : " . $Telephone . " existe déjà";
                                }
                                
                                elseif ($resultPassword > 0) {
                                    echo "Erreur lors de la crétion du compte, le mot de passe : " . $password . " existe déjà";
                                } 

                            }
                            else {
                                echo "Le mot de passe ne correspond pas a sa confirmation..";
                            }
                        }
                        else {
                            echo "Merci de compléter TOUS les champs !";
                        }


                    }




                    //CONNEXION

                    if(isset($_POST['lformsend'])) {
                        
                        $lemail = $_POST['lemail'];
                        $lpassword = $_POST['lpassword'];
                        
                        if(!empty($lemail) && !empty($lpassword)) {

                            $connectEmail = $db->prepare("SELECT * FROM users WHERE email = :email");
                            $connectEmail->execute(['email' => $lemail]);
                            $connectResult = $connectEmail->fetch();

                            if($connectResult == true) {
                                //Le compte existe

                                if(password_verify($lpassword, $connectResult['password'])) {
                                    echo "Le mot de passe est valide, connection en cours";
                                    
                                    $_SESSION['pseudo'] = $connectResult['pseudo'];
                                    $_SESSION['email'] = $connectResult['email'];
                                    $_SESSION['date'] = $connectResult['date'];
                                    
                                    header('Refresh: 1; url=index2.php');
                                }
                                else {
                                    echo "Le mot de passe n'est pas correct";
                                }
                            } 
                            else {
                                echo "Le compte portant l'e-mail : " . $lemail . "n'est associer à aucun compte";
                            }
                            
                        }
                        else {
                            echo "Merci de compléter TOUS les champs !";
                        }
                    }

                ?>
            </div>
        </div>

        
    
    
    </body>
</html>