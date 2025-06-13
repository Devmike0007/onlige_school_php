<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

if (isset($_POST['valider'])) {
    if (
        isset($_FILES['image']) && $_FILES['image']['error'] === 0 &&
        !empty($_POST['titre']) &&
        !empty($_POST['date']) &&
        !empty($_POST['description']) &&
        !empty($_POST['lien'])
    ) {
        $image = $_FILES['image'];
        $imageName = time() . '_' . basename($image['name']);
        $uploadPath = 'img/photo_article/' . $imageName;

        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            $titre = htmlspecialchars($_POST['titre']);
            $date = $_POST['date'];
            $description = htmlspecialchars($_POST['description']);
            $lien = htmlspecialchars($_POST['lien']);

            $requete = $bdd->prepare("INSERT INTO posts (image_post, titre_post, date_post, description_post, lien_post) 
                                      VALUES (:image_post, :titre_post, :date_post, :description_post, :lien_post)");
            $requete->bindValue(':image_post', $imageName);
            $requete->bindValue(':titre_post', $titre);
            $requete->bindValue(':date_post', $date);
            $requete->bindValue(':description_post', $description);
            $requete->bindValue(':lien_post', $lien);

            $result = $requete->execute();

            if ($result) {
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<p class='error'>Erreur lors de l'enregistrement.</p>";
            }
        } else {
            echo "<p class='error'>Erreur lors de l'envoi du fichier.</p>";
        }
    } else {
        echo "<p class='error'>Veuillez remplir tous les champs.</p>";
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
            <div class="balise un">
                <a href="index.php">
                    <i class="fa-solid fa-child"></i>
                    <p>Tableau de bord</p>
                </a>
            </div>
            <div class="balise un">
                <a href="matiere.php">
                    <i class="fa-solid fa-book"></i>
                    <p>Matière</p>
                </a>
            </div>
            <div class="balise un">
                <a href="galerie.php">
                    <i class="fa-solid fa-newspaper"></i>
                    <p>Article</p>
                </a>
            </div>
            <div class="balise un">
                <a href="galerie.php">
                    <i class="fa-solid fa-image"></i>
                    <p>Galerie</p>
                </a>
            </div>
            <div class="balise un">
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
                    <p> Ajouter un article </p>
                    <h1> La description doit avoir moins de 300 caractères</h1>
                    

                    <div class="grandlien">
                        <div class="box">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="image" name="image">
                        </div>
                        <div class="box">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" class="titre" name="titre">
                        </div>
                        <div class="box">
                            <label for="date">Date</label>
                            <input type="date" id="date" class="date" name="date">
                        </div>
                    </div>

                    <div class="grandlien">
                        <div class="box">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="box">
                            <label for="lien">Lien</label>
                            <input type="text" id="lien" class="lien" name="lien">
                        </div>
                        <div class="box">
                            <input type="submit" id="valider" class="valider" name="valider">
                        </div>
                    </div>
                </form>
            </div>

            <div class="affiche_article">
                <?php
                $requete = "SELECT * FROM posts ORDER BY id_post ASC";
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
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Lien</th>
                        <th>Modification</th>
                        <th>Suppression</th>
                    </tr>
                    <?php
                    while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$ligne['id_post']}</td>";
                        echo "<td><img src='img/photo_article/{$ligne['image_post']}' width='80'></td>";
                        echo "<td>{$ligne['titre_post']}</td>";
                        echo "<td>{$ligne['date_post']}</td>";
                        echo "<td>{$ligne['description_post']}</td>";
                        echo "<td><a href='{$ligne['lien_post']}' target='_blank'>Voir</a></td>";
                        echo "<td><a href='modifier_article.php?id_post={$ligne['id_post']}'>Modifier</a></td>";
                        echo "<td><a href='supprimer_article.php?id_post={$ligne['id_post']}'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                    $result->closeCursor();
                    ?>
                </table>
            </div>
        </div>
    </section>
</main>
</body>
</html>
