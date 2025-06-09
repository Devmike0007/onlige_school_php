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

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <?php if (isset($message)) echo htmlspecialchars($message); ?>
                                    <h3 class="text-center font-weight-light my-4">Réinitialisation du mot de passe</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Veuillez rentrer un nouveau mot de passe.</div>
                                    <form action="new_password.php?email=<?php echo urlencode($email); ?>&token=<?php echo urlencode($token); ?>" method="post">
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" />
                                                    <label for="password">Mot de passe</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password" />
                                                    <label for="confirm_password">Confirmer le mot de passe</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="login.php">Connexion</a>
                                            <input type="submit" name="new_password" class="btn btn-primary" value="Valider" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php require_once 'includes/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
