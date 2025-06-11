<?php
session_start();
require_once 'includes/bdd.php';
require_once 'includes/header_login.php';

if (isset($_GET['modifier_compte']) && isset($_SESSION['id_utilisateur']) && $_GET['modifier_compte'] == $_SESSION['id_utilisateur']) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $requete = "SELECT * FROM onligne_schools.utilisateurs WHERE id_utilisateur=$id_utilisateur AND role_utilisateur='Admin'";
    $result = $bdd->query($requete);
    $ligne = $result->fetch(PDO::FETCH_ASSOC);

    $nom_utilisateur = $ligne['nom_utilisateur'];
    $prenom_utilisateur = $ligne['prenom_utilisateur'];
    $username = $ligne['username'];
    $photo_profil = $ligne['photo_utilisateur'];

    if (isset($_POST['modif_profil'])) {
        if (empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])) {
            $message = "Votre prénom doit être une chaîne de caractères";
        } elseif (empty($_POST['nom']) || !ctype_alpha($_POST['nom'])) {
            $message = "Votre nom doit être une chaîne de caractères";
        } elseif (empty($_POST['username']) || !ctype_alnum($_POST['username'])) {
            $message = "Votre nom d'utilisateur doit être alphanumérique";
        } else {
            $req = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE username = :username AND role_utilisateur=:role_utilisateur');
            $req->bindValue(':username', $_POST['username']);
            $req->bindValue(':role_utilisateur', 'Admin');
            $req->execute();
            $resultat = $req->fetch();

            if ($resultat) {
                $message = "Le nom d'utilisateur saisi existe déjà, merci d'en choisir un autre.";
            } else {
                $requete2 = $bdd->prepare('UPDATE onligne_schools.utilisateurs SET nom_utilisateur = :nom, prenom_utilisateur = :prenom, username = :username, photo_utilisateur = :photo_profil WHERE id_utilisateur = :id_utilisateur AND role_utilisateur=:role_utilisateur');
                $requete2->bindValue(':id_utilisateur', $id_utilisateur);
                $requete2->bindValue(':nom', $_POST['nom']);
                $requete2->bindValue(':prenom', $_POST['prenom']);
                $requete2->bindValue(':username', $_POST['username']);
                $requete2->bindValue(':role_utilisateur', 'Admin');

                if (empty($_FILES['photo_profil']['name'])) {
                    $requete2->bindValue(':photo_profil', $photo_profil);
                } else {
                    if (preg_match("#jpeg|png|jpg#", $_FILES['photo_profil']['type'])) {
                        require_once "includes/token.php";
                        $nouveau_nom_photo = $token . "_" . $_FILES['photo_profil']['name'];
                        $path = "img/photo_profil/";
                        move_uploaded_file($_FILES['photo_profil']['tmp_name'], $path . $nouveau_nom_photo);
                        $requete2->bindValue(':photo_profil', $nouveau_nom_photo);
                    } else {
                        $message = "La photo de profil doit être de type jpeg, jpg ou png.";
                        $requete2->bindValue(':photo_profil', $photo_profil);
                    }
                }

                $result2 = $requete2->execute();
                if ($result2) {
                    header('Location: profil.php');
                    exit();
                } else {
                    $message = "Votre profil n'a pas été modifié.";
                }
            }
        }
    }
}
?>

<!-- Formulaire -->
<body>
    <main>
        <div class="container">
            <!-- Sidebar -->
            <div class="sibedar">
                <div class="photo">
                    <?php if (isset($photo_profil)) echo "<center><img width=150 class='media-objeect' src='img/photo_profil/$photo_profil' alt='photo de profil'/></center>"; ?>
                    <div class="titre">
                        <p><?php if(isset($nom_utilisateur)) echo " " . $nom_utilisateur ?> </p>
                        <p><?php if(isset($prenom_utilisateur)) echo " " . $prenom_utilisateur ?> </p>
                    </div>
                </div>
                <div class="ligne">
                    <a href="http://localhost/onligne_school/admin/profil.php"><i></i>Annuel</a>
                    <a href="http://localhost/onligne_school/mon_enfant/mon_enfants.php"><i></i>Mon enfant</a>
                </div>
            </div>

            <!-- Contenu central -->
            <div class="center">
                <div class="header">
                    <?php if (isset($message)) echo "<div class=''>$message</div>"; ?>
                    <h3 class="text-center font-weight-light my-4">Modifier mon profil</h3>
                </div>

                <div class="identite">
                    <form action="modifier_profil.php?modifier_compte=<?= $id_utilisateur ?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input id="prenom" name="prenom" type="text" value="<?= $prenom_utilisateur ?>" />
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input id="nom" name="nom" type="text" value="<?= $nom_utilisateur ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input id="username" name="username" type="text" value="<?= $username ?>" />
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo de profil</label><br>
                                <input id="photo" name="photo_profil" type="file" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="modif_profil" class="btn btn-primary btn-block" value="Modifier mon profil">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>