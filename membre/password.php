<?php require_once 'includes/header_register.php'
?>
 <?php
    if(isset($_POST['forget_password'])){
        if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $message="Rentrer une adresse email valide!";
        }
        else{
            require_once "includes/bdd.php";
            $requete = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE email_utilisateur =:email');
            $requete->bindvalue(':email',$_POST['email']);
            $requete->execute();
            $result = $requete->fetch();
            $nombre = $requete->rowCount();
            if($nombre == 0){
                $message="L'adresse email saisie ne correspond à aucun administrateur !";   
            }
            else{
                if($result['validation_email_utilisateur']!= 1){
                    require_once "includes/token.php";
                    $update =$bdd->prepare('UPDATE onligne_schools.utilisateurs SET token_utilisateur =:token WHERE email_utilisateur=:email');
                    $update->bindvalue(':token',$token);
                    $update->bindvalue('email',$_POST['email']);

                    $update->execute();
                    $message="Un mail vient d'etre envoyé à votre adresse email pour confirmer la creation de votre compte !";

                    require_once "includes/PHPMailer/sendemail.php";

                }
                else{
                    require_once "includes/token.php";
                    $update =$bdd->prepare('UPDATE onligne_schools.utilisateurs SET token_utilisateur =:token WHERE email_utilisateur=:email');
                    $update->bindvalue(':token',$token);
                    $update->bindvalue('email',$_POST['email']);
                    $update->execute();
                    $message="✅ Un mail vous a été envoyé pour la reinitialisation de votre mot de paasse. !";

                    require_once "includes/PHPMailer/sendemail_reinitialisation.php";
                }
            }

        }
    }


 ?>



<body>
    <main>
        <div class="center">
            <div class="header">
                <?php if (isset($message)) echo $message; ?>
                <h3 class="titre">Réinitialisation du mot de passe</h3>
                <p class="intro">Veuillez entrer votre adresse email.</p>
            </div>
            <form action="password.php" method="post" class="formulaire">
                <div class="conteneur_element">
                    <label for="inputEmail">Adresse Email</label>
                    <input id="inputEmail" type="email" name="email" placeholder="name@example.com" required />
                </div>
                <div class="btn-inscription">
                    <input type="submit" name="forget_password" class="btn-submit" value="Réinitialiser le mot de passe" />
                </div>
                <div class="footer">
                    <a class="small" href="http://localhost/onligne_school/mon_enfant/login.php">← Retour à la connexion</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
     
