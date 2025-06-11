<?php require_once 'includes/header_login.php'; ?>

<?php
if (isset($_GET['email'], $_GET['token']) && !empty($_GET['email']) && !empty($_GET['token'])) {

    $email = $_GET['email'];
    $token = $_GET['token'];

    require_once 'includes/bdd.php';

    // Vérification que l'email et le token existent bien en base
    $requete = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE email_utilisateur = :email AND token_utilisateur = :token');
    $requete->bindValue(':email', $email);
    $requete->bindValue(':token', $token);

    $requete->execute();

    $nombre = $requete->rowCount();

    if ($nombre != 1) {
        header('Location: login.php');
        exit();
    } else {
        if (isset($_POST['new_password'])) {

            if (empty($_POST['password']) || $_POST['password'] != $_POST['confirm_password']) {
                $message = "⚠️ Rentrer un mot de passe valide !";
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $req = $bdd->prepare('UPDATE onligne_schools.utilisateurs SET password_utilisateur = :password WHERE email_utilisateur = :email AND token_utilisateur = :token ');
                $req->bindValue(':email', $_POST['email']);
                $req->bindValue(':token', $_POST['token']);
                $req->bindValue(':password', $password);

                $result = $req->execute();

                if ($result) {
                    echo "<script type=\"text/javascript\">
                            alert('Votre mot de passe a bien été réinitialisé !');
                            document.location.href='http://localhost/onligne_school/mon_enfant/login.php';
                          </script>";
                    exit();
                } else {
                    header('Location: password.php');
                    exit();
                }
            }
        }
    }
} else {
    header('Location: password.php');
    exit();
}
?>

<body class="">
    <main>
        <div class="container">
            <div class="contenue">
                <div class="header">
                    <?php if (isset($message)) echo htmlspecialchars($message); ?>
                    <h3 class="">Réinitialisation du mot de passe</h3>
                </div>
                <div class="center">
                    <div class="">Veuillez rentrer un nouveau mot de passe.</div>
                    <form action="new_password.php?email=<?php echo urlencode($email); ?>&token=<?php echo urlencode($token); ?>" method="post">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                        <div class="deuxconteneur">
                            <div class="">
                                <div class="">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" />
                                    <label for="password">Mot de passe</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password" />
                                    <label for="confirm_password">Confirmer le mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <a class="small" href="login.php">Connexion</a>
                            <input type="submit" name="new_password" class="btn btn-primary" value="Valider" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
