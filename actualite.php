<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/fond_et_illustraction/illustration/icon/pile-de-livres.png">
    <link rel="stylesheet" href="./css/actualite.css">
    <title>Actualité</title>
</head>
<body>
   <?php require_once 'includes/header.php'; 
    require_once 'includes/bdd.php';
   ?>

    <main>

        <section id="bannier">
            <div class="top">
                <h1>Blog & Galerie du<br> <span> Complexe Scolaire Ado </span></h1>
                <p>Bienvenue sur la page Blog & Galerie du Complexe Scolaire Ado. 
                    Cet espace est dédié à partager les moments forts de la vie scolaire, 
                    les événements marquants et les activités pédagogiques qui enrichissent le parcours de nos élèves. 
                    Vous trouverez ici des articles inspirants, des témoignages d'élèves et d'enseignants, 
                    ainsi que des galeries de photos et vidéos pour revivre les instants clés de notre établissement.</p>
            </div>
            <div class="bottom">
                <img src="./images/Personnages/photoActulite/Why You Need To Be The CEO Of Your Career.png" alt="prof">
            </div>
        </section>

        <section class="actualite">
            <h1><span>Section Blog 📝</span><br>
                Derniers Articles & Actualités</h1>
            <div class="conteneur">
                <?php
                    $requete = "SELECT * FROM posts ORDER BY id_post ASC ";
                    $result = $bdd->query($requete);
                    if (!$result){
                        echo "la recuperation des donnees a echoue";
                    }
                    else{
                        while($ligne = $result->fetch(PDO::FETCH_ASSOC)){
                            $id_article =$ligne['id_post'];
                            $titre_article = $ligne['titre_post'];
                            $date_article = $ligne['date_post'];
                            $image_article = $ligne['image_post'];
                            $description_article =$ligne['description_post'];
                            
                       

                    ?> 
                <div class="card">

                    <div class="photo_de_larticle"> 
                            <img src="admin/img/photo_article/<?php echo $image_article; ?>" alt="article image">
                    </div>
                    <div class="titre_sous_titre">
                        <h3>📢 <?php echo $titre_article; ?> </h3>
                        <p>📅 Date : <?php echo $date_article; ?></p>
                    </div>
                    <div class="detail">
                        <p><?php echo $description_article; ?></p>
                    </div>
                    <div class="bas_du_card">
                        <a href="./doc/📝 Liste de Fournitures Scolaires.pdf"></a>
                            <div class="telecharger">
                                    <div class="icon"><img src="./images/fond_et_illustraction/illustration/telecharger.png" alt=""></div>
                                    <p> <a href="./doc/📝 Liste de Fournitures Scolaires.pdf">telecharger</a> </p>
                            </div>
                        </a>
                        <div class="autr">
                        </div>
                    </div>
                </div>
  <?php 
   }
}
?>
            </div>
        </section>
        <section class="Galerie">
            <h1><span>Section Galerie 📸</span><br>
                Moments forts en images</h1>
            <div class="conteneur">
            <?php
                    $requete = "SELECT * FROM galeries ORDER BY id_galerie ASC";
                    $result = $bdd->query($requete);
                    if (!$result){
                        echo "la recuperation des donnees a echoue";
                    }
                    else{
                        while($ligne = $result->fetch(PDO::FETCH_ASSOC)){
                            $titre_galerie =$ligne['titre_galerie'];
                            $description_galerie = $ligne['description_galerie'];
                            $lien_galerie = $ligne['lien_galerie'];
                    ?>
                    <div class="galerie">
                    <div class="tranp">
                        <div class="conten">
                            <h1> <?php echo $titre_galerie ?></h1>
                            <p> <?php echo $description_galerie ?> </p>
                            <div class="telechargement">
                                <img src="./images/fond_et_illustraction/illustration/telechargements.png" alt="">
                                <p> Télécharger le pack </p>
                            </div>
                        </div>
                    </div>
                    <div class="images">
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                                echo "<img src='admin/img/photo_galerie/{$ligne['image_galerie' . $i]}' alt='photo'>";
                            }
                            ?>
                       
                    </div>
                </div>
            </div>  
                                   
  <?php 
   }
}
?>
        </section>
    </main>

    <?php require_once 'includes/footer.php'; ?>
    
</body>
</html>