<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

// Récupération de l'article si ce n'est pas encore un envoi POST
if (!isset($_POST['modif'])) {
    $id_post = $_GET['id_post'];
    $requete = "SELECT * FROM posts WHERE id_post = ?";
    $stmt = $bdd->prepare($requete);
    $stmt->execute([$id_post]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="modif">
    <form action="modifier_article.php" method="post" enctype="multipart/form-data">
        <p>Modifier un article</p>
        <h1>La description doit avoir moins de 300 caractères</h1>

        <div class="grandlien">
            <div class="box">
                <label for="image">Image</label><br>
                <!-- Aperçu de l'image actuelle -->
                <?php if (!empty($data['image_post'])): ?>
                    <img src="img/photo_article/<?php echo $data['image_post']; ?>" width="150" alt="Image actuelle"><br>
                <?php endif; ?>
                <input type="file" id="image" class="image" name="image">
            </div>

            <div class="box">
                <label for="titre">Titre</label>
                <input type="text" id="titre" class="titre" name="titre" value="<?php echo htmlspecialchars($data['titre_post']); ?>" required>
            </div>

            <div class="box">
                <label for="date">Date</label>
                <input type="date" id="date" class="date" name="date" value="<?php echo $data['date_post']; ?>" required>
            </div>
        </div>

        <div class="grandlien">
            <div class="box">
                <label for="description">Description</label>
                <textarea name="description" id="description" maxlength="300" required><?php echo htmlspecialchars($data['description_post']); ?></textarea>
            </div>

            <div class="box">
                <label for="lien">Lien</label>
                <input type="text" id="lien" class="lien" name="lien" value="<?php echo htmlspecialchars($data['lien_post']); ?>" required>
            </div>

            <div class="box">
                <input type="hidden" name="id_post" value="<?php echo $data['id_post']; ?>">
                <input type="submit" id="valider" class="valider" name="modif" value="Modifier">
            </div>
        </div>
    </form>
</div>

<?php  
// Traitement du formulaire
if (
    isset($_POST['modif']) &&
    isset($_POST['titre']) &&
    isset($_POST['date']) &&
    isset($_POST['description']) &&
    isset($_POST['lien']) &&
    isset($_POST['id_post'])
) {
    $titre = $_POST['titre'];  
    $date = $_POST['date'];
    $description = $_POST['description'];
    $lien = $_POST['lien'];
    $id_post = $_POST['id_post'];

    // Récupérer ancienne image
    $stmt_old = $bdd->prepare("SELECT image_post FROM posts WHERE id_post = ?");
    $stmt_old->execute([$id_post]);
    $old_data = $stmt_old->fetch(PDO::FETCH_ASSOC);
    $ancienne_image = $old_data['image_post'];

    // Gérer l'upload d'image
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, 'img/photo_article/' . $image);
    } else {
        $image = $ancienne_image;
    }

    // Mise à jour en base de données
    $requete = $bdd->prepare("
        UPDATE posts SET 
            image_post = :image,
            titre_post = :titre,
            date_post = :date,
            description_post = :description,
            lien_post = :lien
        WHERE id_post = :id_post
    ");

    $requete->bindValue(':image', $image);
    $requete->bindValue(':titre', $titre);
    $requete->bindValue(':date', $date);
    $requete->bindValue(':description', $description);
    $requete->bindValue(':lien', $lien);
    $requete->bindValue(':id_post', $id_post);

    $result = $requete->execute();

    if ($result) {
        echo "<script>alert('Modification réussie !'); window.location.href='article.php';</script>";
        exit();
    } else {
        echo "<p class='error'>Erreur lors de la modification de l'article.</p>";
    }
}
?>
