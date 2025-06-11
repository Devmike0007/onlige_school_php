<?php
    if (isset($_POST['connexion'])){
        $email = $_POST['email'];
        $password = $_POST['password']; 
        require_once 'includes/bdd.php';
        $requete = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE email_utilisateur = :email');
        $requete->execute(array('email' => $email));
        $resultat = $requete->fetch();
        if(!$resultat){
            $message = "Aucun compte ne correspond à cette adresse email.";
        } elseif($resultat['validation_email_utilisateur'] == 0){
            require_once 'includes/token.php';
            $update = $bdd->prepare('UPDATE onligne_schools.utilisateurs SET token_utilisateur = :token WHERE email_utilisateur = :email');
            $update->bindValue(':token', $token);
            $update->bindValue(':email', $_POST['email']);
            $update->execute();
            require_once '../membre/includes/PHPMailer/sendemail.php';

        }else{
            $passwordIsOK=password_verify($_POST['password'],$resultat['password_utilisateur']);
            if($passwordIsOK){
                session_start();

                $_SESSION['id_utilisateur']=$resultat['id_utilisateur'];
                $_SESSION['username']=$resultat['username'];
                $_SESSION['email_utilisateur'] = $email;
                $_SESSION['role_utilisateur'] = $resultat['role_utilisateur'];
                $_SESSION['photo_utilisateur'] = $resultat['photo_utilisateur'];

                if(isset($_POST['sesouvenir'])){
                    setcookie("email",$_POST['email'],time()+3600*24*365);
                    setcookie("password",$_POST['password'],time()+3600*24*365);
                }
                else{
                    if(isset($_COOKIE['email'])){
                        setcookie($_COOKIE['email'], "");

                    }
                    if(isset($_COOKIE['password'])){
                        setcookie($_COOKIE['password'],"");
                    }
                }

                header('location:mon_enfant_choix.php');

            }else{
                $message = "Veuillez saisir un mot de passe valide";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion_mon_enfant.css">
    <title>Connexion</title>
</head>
<body>
    <main>
        <div class="gauche">
            <div class="top">
                <h1>Bienvenue dans l’Espace 
                    Parent</h1>
                <p>Accompagnez la réussite scolaire de votre enfant, en toute simplicité.</p>
            </div>
            <div class="bottom">
                <img src="./images/Personnages/monenfant/connexion/Fichier 1.svg" alt="">
                <div class="resaux">
                    <a href="www.facebook.com"><img src="./images/Personnages/monenfant/icon/facebook.png" alt="facebook"></a>
                    <a href="www.linkedin.com"><img src="./images/Personnages/monenfant/icon/logo-linkedin.png" alt="facebook"></a>
                    <a href="www.youtube.com"><img src="./images/Personnages/monenfant/icon/youtube.png" alt="facebook"></a>
                    <a href="www.instagram.com"><img src="./images/Personnages/monenfant/icon/instagram.png" alt="facebook"></a>
                </div>
            </div>
        </div>

     

        <div class="droite">
            <div class="logo">
                <img src="./images/fond_et_illustraction/illustration/Logo.png" alt="logo">
            </div>
            <div class="connexion">
                <h1>Connexion</h1>
                <?php if (isset($message)) echo $message; ?>
                  

                <form action="login.php" method="post">
                    <div class="email">
                        <label for="">Email address</label>
                        <input type="email" name="email" id="email" placeholder="email@janesfakedomain.net" required>
                    </div>
                    <div class="code">
                        <label for="">Mot de pass</label>
                        <input type="password" name="password" id="password" placeholder="*********" required>
                    </div>
                    <button type="submit" name="connexion">Se connexion</button>

                    <div class="mot_de_passe_oublie">
                        <a href="http://localhost/onligne_school/membre/password.php"><img src="./images/Personnages/monenfant/icon/cadenas.png" alt="cadenas"><p>Mot de passe oublié ?</p></a>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>
</html>