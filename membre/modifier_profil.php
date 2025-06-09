<?php
session_start();
require_once 'includes/bdd.php';
require_once 'includes/header_login.php';

if (isset($_GET['modifier_compte']) && isset($_SESSION['id_utilisateur']) && $_GET['modifier_compte'] == $_SESSION['id_utilisateur']) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $requete = "SELECT * FROM onligne_schools.utilisateurs WHERE id_utilisateur=$id_utilisateur ";
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
            $req = $bdd->prepare('SELECT * FROM onligne_schools.utilisateurs WHERE username = :username');
            $req->bindValue(':username', $_POST['username']);
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
                        $path = "img/photoprofil/";
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
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <?php if (isset($message)) echo "<div class='alert alert-warning'>$message</div>"; ?>
                                <h3 class="text-center font-weight-light my-4">Modifier mon profil</h3>
                            </div>
                            <div class="card-body">
                                <form action="modifier_profil.php?modifier_compte=<?= $id_utilisateur ?>" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="prenom" name="prenom" type="text" value="<?= $prenom_utilisateur ?>" />
                                                <label for="prenom">Prénom</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="nom" name="nom" type="text" value="<?= $nom_utilisateur ?>" />
                                                <label for="nom">Nom</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="username" name="username" type="text" value="<?= $username ?>" />
                                                <label for="username">Nom d'utilisateur</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <img width="50" class="media-object mb-2" src="img/photoprofil/<?= $photo_profil ?>" alt="photo de profil" />
                                                <label for="photo">Photo de profil</label>
                                                <input class="form-control" id="photo" name="photo_profil" type="file" accept="image/*" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" name="modif_profil" class="btn btn-primary btn-block" value="Modifier mon profil">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
