<?php require_once 'includes/bdd.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/fond_et_illustraction/illustration/icon/pile-de-livres.png">
    <link rel="stylesheet" href="./css/index.css">
    <title>Accueil</title>
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    <main>
        <section class="banniere">
            <div class="gauche">
                <h1>Un Enseignement d’excellence pour un avenir réussi. </h1>
                <p>Un cadre inspirant, des programmes adaptés, 
                    une réussite assurée. Ensemble, cultivons l’avenir !</p>
                <div class="bouton">
                    <a href="MES RESULTATS SUR CISNET.pdf" download>Inscription</a>
                </div>
            </div>
            <div class="droite">
                <div class="photo">
                    <img src="./images/Personnages/accueil/garcon.png" alt="photo eleve">
                </div>
            </div>
        </section>

        
        <section class="actualite" id="actualite">
            <h1>Actualité</h1>
            <div class="conteneur">
                <?php
                    $requete = "SELECT * FROM posts ORDER BY id_post ASC LIMIT 3";
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
                                    <p> <a href="<?php echo $lien_article; ?>"> Lien</a> </p>
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
        <section class="Apropos" id="Apropos">
            <div class="gauche">
                <h1>A propos</h1>
                <div class="premierbloc">
                    <h2>Fondé en 2006 par l’honorable michee </h2>
                    <p>Depuis sa création, le Complexe Scolaire Ado s’est engagée à offrir un enseignement de qualité, 
                        adapté aux besoins des élèves et aux défis du monde moderne. 
                        Nous croyons en une éducation qui ne se limite pas à l’acquisition de connaissances, 
                        mais qui vise aussi à développer des compétences essentielles, des valeurs fortes et une ouverture d’esprit. 
                    </p>
                </div>
                <div class="deuxiemebloc">
                    <h2>Notre Mission</h2>
                    <p>Notre mission est d’accompagner nos élèves vers la réussite, 
                        en leur offrant un environnement d’apprentissage dynamique et stimulant. 
                        Nous encourageons la curiosité intellectuelle, l’esprit critique et la créativité, 
                        afin de préparer nos élèves à exceller dans leurs études et à s’adapter aux évolutions de la société.
                    </p>
                </div>
                <a href="#">Lire plus.....</a>
            </div> 
            <div class="droite">
                <img src="./images/Personnages/accueil/apropos.jpeg" alt="photo des eleves">
            </div>
        </section>
        <section class="temoignage" id="temoignage">
            <h1>Temoignage</h1>
            <div class="conteneur">
                <div class="block">
                    <p>L’accompagnement vers le bac et l’orientation post-bac est exceptionnel.
                        Mon fils a pu bénéficier de conseils personnalisés qui 
                        l’ont aidé à choisir son avenir en toute confiance.</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/1F.jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>Mme Garnier</h2>
                            <p> maman de Louis 4e. Scientifique</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>L’entrée au collège était une étape stressante pour nous, 
                        mais cette école a su accompagner ma fille avec bienveillance</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/ac8e2526-5b1e-4bb7-ba92-cd67d662e582.jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>M. Diallo</h2>
                            <p>Papa de Fatou 6e Primaire</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>Depuis que mon fils est dans cette école, 
                        je vois une vraie évolution. Il est plus épanoui,
                         curieux et motivé à apprendre..</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/Birthday Portraits for the amazing Favour__💄….jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>Mme Lemoine</h2>
                            <p>maman de Paul 5e Primaire</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>Ce que j’apprécie le plus dans cette école, c’est la pédagogie active et innovante. 
                        Ma fille rentre chaque jour avec le sourire, 
                        impatiente de raconter tout ce qu’elle a appris !</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/Muà Nkàlu Mzita.jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>M. Benayoun</h2>
                            <p>Papa de Jade 1e Primaire </p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>En plus des cours, l’école propose de nombreuses activités extrascolaires qui permettent 
                        à mon fils de développer ses talents et sa créativité. 
                        Un vrai plus pour son épanouissement !"</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/Portraits Oyin, Jan_ 2025__📸 @thesammieolajide….jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>Mme N’Goran</h2>
                            <p>Maman de Samuel 5e Primaire</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>L’encadrement est excellent. 
                        Les enseignants et le personnel éducatif sont 
                        toujours disponibles pour répondre aux questions et accompagner 
                        les élèves dans leur réussite.</p>
                    <div class="avatar">
                        <div class="phots">
                            <img src="./images/Personnages/photo parent/Peter Bossman (2 November 1955), a Ghanaian-born….jpeg" alt="" class="pht">
                        </div>
                        <div class="name">
                            <h2>M. Fontaine</h2>
                            <p>papa de Léa 3e Primaire </p>
                        </div>
                    </div>
                </div>
        </section>
        <section class="contact" id="contact">
            <div class="gauche">
                <img src="./images/Personnages/accueil/Teaching Pictures _ Freepik.jpeg" alt="">
            </div>
            <div class="droite">
                <form action="includes/traitement.php" method="post">
                    <h1>Contactez-nous</h1>
                    <div class="nom_post">
                        <div class="nom">
                            <label for="">Nom</label>
                            <input type="text" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="post">
                            <label for="">Prenom</label>
                            <input type="text" name="prenom" placeholder="Prenom" required>
                        </div>
                    </div>
                    <div class="email">
                        <label for="">Email address</label>
                        <input type="email" name="email" id="" placeholder="email@janesfakedomain.net" required>
                    </div>
                    <div class="message">
                        <label for="">Votre message</label>
                        <textarea name="message" id="message" placeholder="Enter your question or message" required></textarea>
                    </div>
                    <input type="submit" name="envoyer" placeholder="Envoyer">
                </form>
            </div>
        </section>
        <div class="bareinscription">
            <div class="text">
                <p>Inscrivez votre enfant pour lui assurer un avenir meilleur.
                    Offrez-lui une éducation d'excellence avec un suivi personnalisé.
                    Ensemble, construisons son succès et son épanouissement !</p>
                    <div class="bouton boutondelafin">
                        <a href="#">Inscription</a>
                    </div>
            </div>
            
        </div>       
    </main>
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>