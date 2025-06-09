<?php
    session_start();
    require_once 'includes/bdd.php';
    require_once 'includes/header_login.php';
if(isset($_SESSION['id_utilisateur'])){
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $requete = "SELECT * FROM webcms.utilisateurs WHERE id_utilisateur = $id_utilisateur AND role_utilisateur='Admin'";
    $result = $bdd->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    $nom_utilisateur=$ligne['nom_utilisateur'];
    $prenom_utilisateur=$ligne['prenom_utilisateur'];
    $username=$ligne['username'];
    $email_utilisateur=$ligne['email_utilisateur'];
    $photo_profil = $ligne['photo_utilisateur'];

} else {
    echo "<script type=\"text/javascript\">
    alert('Pour accèder à votre profil, vous devez etre connecte !!');
    document.location.href='login.php';
    </script>";
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
                                    <?php if (isset($message)) echo $message; ?>    
                                    <h3 class="text-center font-weight-light my-4">Profil</h3>
                                    </div>
                                    <div class="card-header">
                                        <?php if (isset($photo_profil)) echo "<center><img width=150 class='media-objeect' src='img/photoprofil/$photo_profil' alt='photo de profil'/></center>"; ?>                                      </div>
                                    <div class="card-body">
                                        <p><?php if(isset($nom_utilisateur)) echo "Nom: ".$nom_utilisateur ?> </p>                                     
                                        <p><?php if(isset($prenom_utilisateur)) echo "prenom: ".$prenom_utilisateur ?> </p>                                     
                                        <p><?php if(isset($username)) echo "username: ".$username ?> </p>                                     
                                        <p><?php if(isset($email_utilisateur)) echo "email: ".$email_utilisateur ?> </p>  

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <?php if(isset($id_utilisateur)){
                                                echo "<a class='small' href='modifier_profil.php?modifier_compte=$id_utilisateur'>modifier mon profil</a>";
                                            }?>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center py-3">
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