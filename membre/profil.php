<?php 
    session_start();
    if(!($_SESSION['id_utilisateur'])){
                 echo "<script type=\"text/javascript\"> alert('Vous devez vous connecter pour acceder au profil.'); document.location.href ='http://localhost/onligne_school/mon_enfant/login.php';</script>";
    }
?>

<?php
    require_once 'includes/bdd.php';
    require_once 'includes/header_login.php';
if(isset($_SESSION['id_utilisateur'])){
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $requete = "SELECT * FROM onligne_schools.utilisateurs WHERE id_utilisateur = $id_utilisateur";
    $result = $bdd->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    $nom_utilisateur=$ligne['nom_utilisateur'];
    $prenom_utilisateur=$ligne['prenom_utilisateur'];
    $username=$ligne['username'];
    $email_utilisateur=$ligne['email_utilisateur'];
    $photo_profil = $ligne['photo_utilisateur'];

    if(isset($_POST['validation_supp_compte'])){
        $requete = $bdd->prepare("DELETE FROM onligne_schools.utilisateurs WHERE id_utilisateur=:id_utilisateur ");
        $requete->bindValue(':id_utilisateur',$id_utilisateur);
        $result = $requete->execute();

        if($result){
            if($_SESSION){
                session_unset();
                session_destroy();
                header('location:http://localhost/onligne_school/index.php');
            }

        }else{
            $message="votre compte n";
        }

    }

} else {
    echo "<script type=\"text/javascript\">
    alert('Pour accèder à votre profil, vous devez etre connecte !!');
    document.location.href='http://localhost/onligne_school/index.php';
    </script>";
}  

?>

<body class="">

    <main>
        <div class="container">
            <div class="sibedar">
                <div class="photo">
                    <?php if (isset($photo_profil)) echo "<center><img width=150 class='media-objeect' src='images/photo_profil/$photo_profil' alt='photo de profil'/></center>"; ?>
                    <div class="titre">
                        <p><?php if(isset($nom_utilisateur)) echo " ".$nom_utilisateur ?> </p>                                     
                        <p><?php if(isset($prenom_utilisateur)) echo  " ".$prenom_utilisateur ?> </p>                                     
                    </div>

                </div>
                <div class="ligne">
                    <a href="http://localhost/onligne_school/index.php"> <i></i>Accueil</a>
                    <a href="http://localhost/onligne_school/mon_enfant/mon_enfants.php"> <i></i> mon enfant</a>
                </div>
            </div>
            <div class="center">
                <div class="header">
                    <?php if (isset($message)) echo $message; ?>    
                    <h3 class="text-center font-weight-light my-4">Profil</h3>
                </div>
                <div class="identite">
                        <p><?php if(isset($nom_utilisateur)) echo "Nom: ".$nom_utilisateur ?> </p>                                     
                        <p><?php if(isset($prenom_utilisateur)) echo "prenom: ".$prenom_utilisateur ?> </p>                                     
                        <p><?php if(isset($username)) echo "username: ".$username ?> </p>                                     
                        <p><?php if(isset($email_utilisateur)) echo "email: ".$email_utilisateur ?> </p>  
                </div>
                <div class="option">
                    <div class="opt">
                        <?php if(isset($id_utilisateur)){
                            echo "<a class='small' href='profil.php?supprimer_compte=$id_utilisateur'>Supprimer mon compte</a>";
                        }?>
                        <?php if(isset($id_utilisateur)){
                            echo "<a class='small' href='modifier_profil.php?modifier_compte=$id_utilisateur'>modifier mon profil</a>";
                        }?>
                    </div>
                    <?php 
                    if (isset($_GET['supprimer_compte']) && isset($_SESSION['id_utilisateur']) && $_GET['supprimer_compte'] == $_SESSION['id_utilisateur']) {
                        echo "Voulez-vous vraiment supprimer votre compte ?";
                        echo '
                            <form action="" method="post">
                                <div class="d-grid">
                                    <input type="submit" name="validation_supp_compte" class="btn btn-primary btn-block" value="Oui supprimer mon compte" />
                                </div>
                            </form>
                        '; } ?>
                </div>
            </div>

    </main>
</body>
</html>
    