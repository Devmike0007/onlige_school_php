<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

try {
    if (isset($_POST['supprimer'])) {
        $id_galerie = $_POST['id_galerie'];

        $requete = $bdd->prepare("DELETE FROM galeries WHERE id_galerie = :id_galerie");
        $requete->bindParam(':id_galerie', $id_galerie, PDO::PARAM_INT);
        $result = $requete->execute();

        if ($result) {
            echo "<script>alert('Galerie supprimée avec succès !'); window.location.href = 'galerie.php';</script>";
            exit();
        } else {
            echo "<p class='error'>Erreur lors de la suppression.</p>";
        }

    } elseif (isset($_GET['id_galerie'])) {
        $id_galerie = $_GET['id_galerie'];

        $requete = $bdd->prepare("SELECT * FROM galeries WHERE id_galerie = :id_galerie");
        $requete->bindParam(':id_galerie', $id_galerie, PDO::PARAM_INT);
        $requete->execute();

        $data = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            echo "<p class='error'>Galerie introuvable.</p>";
            exit();
        }
?>

<!-- Formulaire de confirmation de suppression -->
<div class="modif">
    <form action="supprimer_galerie.php" method="post">
        <p>Supprimer une galerie</p>
        <h1>Êtes-vous sûr de vouloir supprimer cette galerie ?</h1>

        <div class="grandlien">
            <div class="box">
                <label for="image">Image principale</label><br>
                <?php if (!empty($data['image_galerie1'])): ?>
                    <img src="img/photo_galerie/<?php echo $data['image_galerie1']; ?>" width="150" alt="Image actuelle"><br>
                <?php endif; ?>
            </div>

            <div class="box">
                <label for="titre">Titre</label>
                <input type="text" name="titre" value="<?php echo htmlspecialchars($data['titre_galerie']); ?>" disabled>
            </div>

            <div class="box">
                <label for="lien">Lien</label>
                <input type="text" name="lien" value="<?php echo htmlspecialchars($data['lien_galerie']); ?>" disabled>
            </div>

            <div class="box">
                <label for="description">Description</label>
                <textarea name="description" disabled><?php echo htmlspecialchars($data['description_galerie']); ?></textarea>
            </div>

            <div class="box">
                <input type="hidden" name="id_galerie" value="<?php echo $data['id_galerie']; ?>">
                <input type="submit" name="supprimer" class="valider danger" value="Supprimer définitivement">
            </div>
            <div class="box">
                <a href="galerie.php" class="valider" style="background:#aaa;text-align:center;display:inline-block;padding:10px 20px;border-radius:5px;color:white;text-decoration:none;">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?php
    } else {
        echo "<p class='error'>Aucune galerie spécifiée.</p>";
    }
} catch (PDOException $e) {
    echo "<p class='error'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
