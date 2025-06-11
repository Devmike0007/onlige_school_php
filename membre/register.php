<?php 
    session_start();
    if(!($_SESSION['id_utilisateur']  && $_SESSION['role_utilisateur'] && $_SESSION['role_utilisateur'] == 'Admin')){
                 echo "<script type=\"text/javascript\"> alert('Espace reserver aux administrateur.'); document.location.href ='http://localhost/onligne_school/index.php';</script>";


    }

?>
<?php
   if (isset($_POST['inscription'])){
        if(empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])){
            $message = "Votre prenom doit etre une chaine de caractere";
        } elseif(empty($_POST['nom']) || !ctype_alpha($_POST['nom'])){
            $message = "Votre nom doit etre une chaine de caractere";
                }
        elseif(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $message = "Votre email n'est pas valide";
        } elseif(empty($_POST['username']) || !ctype_alnum($_POST['username'])){
            $message = "Votre nom d'utilisateur doit etre une chaine de caractere alphanumérique";
                }
        elseif(empty($_POST['password']) || $_POST['password'] != $_POST['confirm_password']){
            $message = "Vos mots de passe ne correspondent pas";
        } else { 
        //COnnection à la base de données
         session_start();
         $_SESSION['username'] = $_POST['username'];
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['nom'] = $_POST['nom'];
         $_SESSION['prenom'] = $_POST['prenom'];
         $_SESSION['photo_profil'] = "img/photoprofil/default.png";
         // Inclusion du fichier de connexion à la base de données
         // Assurez-vous que le fichier bdd.php est dans le même répertoire que ce fichier
         // ou ajustez le chemin en conséquence
         // Si vous avez un dossier "includes", utilisez le chemin suivant :
         // require_once 'includes/bdd.php';
       require_once 'includes/bdd.php';
         // Vérification de l'unicité de l'email et du nom d'utilisateur
         //selectionner les utilisateurs avec le nom d'utilisateur avec mm nom d'utilisateur
       $req = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE username = :username');
       $req->bindValue(':username', $_POST['username']);
       $req->execute();
       $resultat = $req->fetch();

            //selectionner les utilisateurs avec l'email avec meme email
       $req = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE email_utilisateur = :email');
       $req->bindValue(':email', $_POST['email']);
       $req->execute();
       $resultat1 = $req->fetch();

       if ($resultat){
              $message = "Ce nom d'utilisateur existe déjà, veuillez en choisir un autre.";
      } elseif ($resultat1) {
              $message = "Cet email est déjà utilisé, veuillez en choisir un autre.";
      } else {
                require_once 'includes/token.php';
                //cripter le mot de passe
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //insertion des donnees dans la base de donnees 
            $requete = $bdd->prepare('INSERT INTO onligne_schools.utilisateurs (nom_utilisateur, prenom_utilisateur, email_utilisateur, password_utilisateur, username, token_utilisateur, photo_utilisateur) VALUES (:nom, :prenom, :email, :password, :username, :token, :photo_profil)');
            $requete->bindValue(':nom', $_POST['nom']);
            $requete->bindValue(':prenom', $_POST['prenom']);
            $requete->bindValue(':email', $_POST['email']);
            $requete->bindValue(':password', $password);
            $requete->bindValue(':username', $_POST['username']);
            $requete->bindValue(':token', $token);

            if (empty($_FILES['photo_profil']['name'])) {
                $photo_profil = "img/photoprofil/avatar.png";
                $requete->bindValue(':photo_profil', $photo_profil);
            } else {
                // ➤ Traitement de l’upload du fichier
                if(preg_match("#jpeg|png|jpg#", $_FILES['photo_profil']['type'])){
                    $nouveau_nom_photo = $token."_".$_FILES['photo_profil']['name'];
                    
                    $path = "images/photo_profil/";

                    move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$nouveau_nom_photo);
                }else{
                    $message = "La photo de profil doit etre de type jpeg,jpg ou png";

                }
                $requete->bindValue(':photo_profil', $nouveau_nom_photo);
            }

            $requete->execute();
            $message ="✅ Un mail vous a été envoyé.";
            require_once 'includes/PHPMailer/sendemail.php';

        }
    }
    }
?>
<?php
require_once 'includes/header_register.php';
?>
<!------ formulaire---------->

<body>
    <main>
        <div class="center">
            <div class="header">
                <?php if (isset($message)) echo $message; ?>
                <h3 class="text-center font-weight-light my-4">Créer un compte membre</h3>
            </div>

            <div class="formulaire">
                <form action="register.php" method="post" enctype="multipart/form-data">
                    <div class="deuxconteneur">
                        <div class="conteneur_element">
                            <label for="prenom">Prénom</label>
                            <input id="prenom" name="prenom" type="text" placeholder="Prénom" />
                        </div>
                        <div class="conteneur_element">
                            <label for="nom">Nom</label>
                            <input id="nom" name="nom" type="text" placeholder="Nom" />
                        </div>
                    </div>

                    <div class="conteneur_element">
                        <label for="email">Adresse e-mail</label>
                        <input id="email" name="email" type="email" placeholder="nom@exemple.com" />
                    </div>

                    <div class="deuxconteneur">
                        <div class="conteneur_element">
                            <label for="password">Mot de passe</label>
                            <input id="password" name="password" type="password" placeholder="Mot de passe" />
                        </div>
                        <div class="conteneur_element">
                            <label for="confirm_password">Confirmer mot de passe</label>
                            <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirmer mot de passe" />
                        </div>
                    </div>

                    <div class="deuxconteneur">
                        <div class="conteneur_element">
                            <label for="username">Nom d'utilisateur</label>
                            <input id="username" name="username" type="text" placeholder="Nom d'utilisateur" />
                        </div>
                        <div class="conteneur_element">
                            <label for="photo">Photo de profil</label>
                            <input id="photo" name="photo_profil" type="file" accept="image/*" />
                        </div>
                    </div>

                    <div class="btn-inscription">
                        <input type="submit" name="inscription" value="Créer un compte">
                    </div>
                </form>
            </div>

            <div class="footer">
                <p><a href="http://localhost/onligne_school/mon_enfant/login.php">Vous avez déjà un compte ? Se connecter</a></p>
            </div>
        </div>
    </main>
</body>


