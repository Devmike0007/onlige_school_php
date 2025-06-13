<?php
require_once 'includes/header_admin.php';
require_once 'includes/bdd.php';

// Récupération des infos de la galerie
if (!isset($_POST['modif'])) {
    $id_galerie = $_GET['id_galerie'];
    $requete = "SELECT * FROM galeries WHERE id_galerie = ?";
    $result = $bdd->prepare($requete);
    $result->execute([$id_galerie]);
    $data = $result->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="modif">
    <form action="modifier_galerie.php" method="post" enctype="multipart/form-data">
        <p>Modifier une Galerie</p>
        <h1>La description doit avoir moins de 300 caractères</h1>

        <div class="grandlien">            
            <div class="box">
                <label for="titre">Titre</label>
                <input type="text" id="titre" class="titre" name="titre" value="<?= $data['titre_galerie'] ?>">
            </div>
            <div class="box">
                <label for="lien">Lien</label>
                <input type="text" id="lien" class="lien" name="lien" value="<?= $data['lien_galerie'] ?>">
            </div>
            <div class="box">
                <label for="description">Description</label>
                <textarea name="description" id="description"><?= $data['description_galerie'] ?></textarea>
            </div>
        </div>

        <div class="grandlien">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="box">
                    <label for="image<?= $i ?>">Image <?= $i ?></label><br>
                    <img src="img/photo_galerie/<?= $data['image_galerie' . $i] ?>" width="60"><br>
                    <input type="file" name="image<?= $i ?>" accept="image/*">
                    <input type="hidden" name="ancienne_image<?= $i ?>" value="<?= $data['image_galerie' . $i] ?>">
                </div>
            <?php endfor; ?>

            <div class="box">
                <input type="hidden" name="id_galerie" value="<?= $data['id_galerie'] ?>">
                <input type="submit" id="valider" class="valider" name="modif" value="Modifier">
            </div>
        </div>
    </form>
</div>

<?php
if (
    isset($_POST['modif']) &&
    isset($_POST['titre']) &&
    isset($_POST['lien']) &&
    isset($_POST['description']) &&
    isset($_POST['id_galerie'])
) {
    $titre = $_POST['titre'];
    $lien = $_POST['lien'];
    $description = $_POST['description'];
    $id_galerie = $_POST['id_galerie'];

    // Préparer les images
    $images = [];

    for ($i = 1; $i <= 6; $i++) {
        $imageKey = 'image' . $i;
        $ancienKey = 'ancienne_image' . $i;

        if (!empty($_FILES[$imageKey]['name'])) {
            $imageName = time() . '_' . basename($_FILES[$imageKey]['name']); // horodatage pour éviter conflits
            $tmpName = $_FILES[$imageKey]['tmp_name'];
            move_uploaded_file($tmpName, 'img/photo_galerie/' . $imageName);
            $images[$i] = $imageName;
        } else {
            $images[$i] = $_POST[$ancienKey]; // garder l’image précédente
        }
    }

    // Construction de la requête SQL
    $sql = "
        UPDATE galeries SET 
            titre_galerie = :titre,
            lien_galerie = :lien,
            description_galerie = :description,
            image_galerie1 = :img1,
            image_galerie2 = :img2,
            image_galerie3 = :img3,
            image_galerie4 = :img4,
            image_galerie5 = :img5,
            image_galerie6 = :img6
        WHERE id_galerie = :id
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':lien', $lien);
    $stmt->bindValue(':description', $description);
    for ($i = 1; $i <= 6; $i++) {
        $stmt->bindValue(':img' . $i, $images[$i]);
    }
    $stmt->bindValue(':id', $id_galerie);

    if ($stmt->execute()) {
        echo "<script>alert('Modification réussie !'); window.location.href='galerie.php';</script>";
        exit();
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>
