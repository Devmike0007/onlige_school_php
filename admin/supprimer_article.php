<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

try {
    if (isset($_POST['supprimer'])) {
        $id_post = $_POST['id_post']; // CORRECTION : variable correctement nommée

        $requete = $bdd->prepare("DELETE FROM posts WHERE id_post = :id_post");
        $requete->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $result = $requete->execute();

        if ($result) {
            echo "<script>alert('Article supprimé avec succès !'); window.location.href = 'article.php';</script>";
            exit();
        } else {
            echo "<p class='error'>Erreur lors de la suppression.</p>";
        }

    } elseif (isset($_GET['id_post'])) {
        $id_post = $_GET['id_post']; // CORRECTION : variable correctement nommée

        $requete = $bdd->prepare("SELECT * FROM posts WHERE id_post = :id_post");
        $requete->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $requete->execute();

        $data = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            echo "<p class='error'>Article introuvable.</p>";
            exit();
        }
?>

<!-- Formulaire de confirmation de suppression -->
<div class="modif">
    <form action="supprimer_article.php" method="post">
        <p>Supprimer un article</p>
        <h1>Êtes-vous sûr de vouloir supprimer cet article ?</h1>

        <div class="grandlien">
            <div class="box">
                <label for="image">Image</label><br>
                <?php if (!empty($data['image_post'])): ?>
                    <img src="img/photo_article/<?php echo $data['image_post']; ?>" width="150" alt="Image actuelle"><br>
                <?php endif; ?>
            </div>

            <div class="box">
                <label for="titre">Titre</label>
                <input type="text" id="titre" class="titre" name="titre" value="<?php echo htmlspecialchars($data['titre_post']); ?>" disabled>
            </div>

            <div class="box">
                <label for="date">Date</label>
                <input type="date" id="date" class="date" name="date" value="<?php echo $data['date_post']; ?>" disabled>
            </div>
        </div>

        <div class="grandlien">
            <div class="box">
                <label for="description">Description</label>
                <textarea name="description" id="description" maxlength="300" disabled><?php echo htmlspecialchars($data['description_post']); ?></textarea>
            </div>

            <div class="box">
                <label for="lien">Lien</label>
                <input type="text" id="lien" class="lien" name="lien" value="<?php echo htmlspecialchars($data['lien_post']); ?>" disabled>
            </div>
        </div>

        <div class="grandlien">
            <div class="box">
                <input type="hidden" name="id_post" value="<?php echo $data['id_post']; ?>">
                <input type="submit" name="supprimer" class="valider danger" value="Supprimer définitivement">
            </div>
            <div class="box">
                <a href="article.php" class="valider" style="background:#aaa;text-align:center;display:inline-block;padding:10px 20px;border-radius:5px;color:white;text-decoration:none;">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?php
    } else {
        echo "<p class='error'>Aucun article spécifié.</p>";
    }
} catch (PDOException $e) {
    echo "<p class='error'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
