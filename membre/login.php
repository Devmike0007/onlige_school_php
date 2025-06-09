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
            require_once 'includes/PHPMailer/sendemail.php';

        }else{
            $passwordIsOK=password_verify($_POST['password'],$resultat['password_utilisateur']);
            if($passwordIsOK){
                session_start();

                $_SESSION['id_utilisateur']=$resultat['id_utilisateur'];
                $_SESSION['username']=$resultat['username'];
                $_SESSION['email_utilisateur'] = $email;
                $_SESSION['role_utilisateur'] = $resultat['role_utilisateur'];

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

                header('location:index.php');

            }else{
                $message = "Veuillez saisir un mot de passe valide";
            }
        }
    }
?>
<?php
    require_once 'includes/header_login.php';
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    <?php if (isset($message)) echo $message; ?>    
                                    <h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post"> 
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>" />
                                                <label for="inputEmail"> Addresse email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" name="sesouvenir"/>
                                                <label class="form-check-label" for="inputRememberPassword">Se souvenir de moi</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Mot de passe oublie</a>
                                            <input type="submit" value="Connexion" name="connexion" class="btn btn-primary">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php
            require_once 'includes/footer.php';
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
