<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

if (isset($_POST['valider'])) {
    if (
        isset($_FILES['images']) &&
        count($_FILES['images']['name']) === 6 &&
        !empty($_POST['titre']) &&
        !empty($_POST['description']) &&
        !empty($_POST['lien'])
    ) {
        $images = [];
        $uploadDir = 'img/photo_galerie/';
        foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
            $originalName = basename($_FILES['images']['name'][$index]);
            $newName = time() . "_$index" . '_' . $originalName;
            $targetPath = $uploadDir . $newName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $images[] = $newName;
            } else {
                echo "<p class='error'>Erreur lors du téléchargement de l'image $originalName</p>";
                return;
            }
        }

        // Vérifie qu'on a bien 6 images
        if (count($images) !== 6) {
            echo "<p class='error'>Vous devez envoyer exactement 6 images.</p>";
            return;
        }

        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $lien = htmlspecialchars($_POST['lien']);

        $requete = $bdd->prepare("INSERT INTO galeries (titre_galerie, description_galerie, lien_galerie, image_galerie1, image_galerie2, image_galerie3, image_galerie4, image_galerie5, image_galerie6)
                                  VALUES (:titre, :description, :lien, :img1, :img2, :img3, :img4, :img5, :img6)");
        $requete->bindValue(':titre', $titre);
        $requete->bindValue(':description', $description);
        $requete->bindValue(':lien', $lien);
        for ($i = 0; $i < 6; $i++) {
            $requete->bindValue(':img' . ($i + 1), $images[$i]);
        }

        $result = $requete->execute();

        if ($result) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p class='error'>Erreur lors de l'enregistrement en base de données.</p>";
        }
    } else {
        echo "<p class='error'>Veuillez remplir tous les champs et sélectionner 6 images.</p>";
    }
}
?>
<main>
    <section class="gauche">
        <div class="top">
            <img src="<?php echo 'img/photo_profil/' . $_SESSION['photo_utilisateur']; ?>">
            <div class="text">
                <p><?php echo $_SESSION['username'] ?></p>
                <p><?php echo $_SESSION['role_utilisateur'] ?></p>
            </div>
        </div>
        <div class="center">
            <div class="balise">
                <a href="index.php">
                    <i class="fa-solid fa-child"></i>
                    <p>Tableau de bord</p>
                </a>
            </div>
            <div class="balise un">
                <a href="galerie.php">
                    <i class="fa-solid fa-newspaper"></i>
                    <p>Article</p>
                </a>
            </div>
            <div class="balise">
                <a href="galerie.php">
                    <i class="fa-solid fa-image"></i>
                    <p>Galerie</p>
                </a>
            </div>
            <div class="balise">
                <a href="http://localhost/onligne_school/membre/register.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <p>Ajouter le membre</p>
                </a>
            </div>
        </div>

        <div class="bottom">
            <div class="resaux">
            </div>
        </div>
    </section>

    <section class="centre section_article">
        <?php require_once 'includes/topbar_admin.php' ?>

        <div class="centrer article">
            <div class="inscription_article">
                <form action="" method="post" enctype="multipart/form-data">
                    <p> Ajouter un Galerie </p>
                    <h1> La description doit avoir moins de 300 caractères et envoyer 6 images</h1>
                    

                    <div class="grandlien">
                        
                        <div class="box">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" class="titre" name="titre">
                        </div>
                        <div class="box">
                            <label for="date">lien</label>
                            <input type="text" id="lien" class="lien" name="lien">
                        </div>
                         <div class="box">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                    </div>

                    <div class="grandlien">
                    
                        <div class="box">
                            <label>Images (6 fichiers max)</label>
                            <input type="file" name="images[]" accept="image/*" multiple required>
                        </div>
                        
                        <div class="box">
                            <input type="submit" id="valider" class="valider" name="valider">
                        </div>
                    </div>

                    
                </form>
            </div>

            <div class="affiche_article">
                <?php
               $requete = "SELECT * FROM galeries ORDER BY id_galerie ASC";
                $result = $bdd->query($requete);
                if (!$result) {
                    echo "La récupération des données a échoué";
                } else {
                    $nbre_article = $result->rowCount();
                }
                ?>

                <h1>Liste des articles</h1>
                <h4>Il y a <?= $nbre_article ?> article(s) enregistré(s)</h4>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>TItre</th>
                        <th>Description</th>
                        <th>Lien</th>
                        <th>image1</th>
                        <th>image2</th>
                        <th>image3</th>
                        <th>image4</th>
                        <th>image5</th>
                        <th>image6</th>                        
                        <th>Modification</th>
                        <th>Suppression</th>
                    </tr>
                    <?php
                         while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>{$ligne['id_galerie']}</td>";
                            echo "<td>{$ligne['titre_galerie']}</td>";
                            echo "<td>{$ligne['description_galerie']}</td>";
                            echo "<td><a href='{$ligne['lien_galerie']}' target='_blank'>Voir</a></td>";

                            for ($i = 1; $i <= 6; $i++) {
                                echo "<td><img src='img/photo_galerie/{$ligne['image_galerie' . $i]}' width='60'></td>";
                            }

                            echo "<td><a href='modifier_galerie.php?id_galerie={$ligne['id_galerie']}'>Modifier</a></td>";
                            echo "<td><a href='supprimer_galerie.php?id_galerie={$ligne['id_galerie']}'>Supprimer</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</main>
</body>
</html>
