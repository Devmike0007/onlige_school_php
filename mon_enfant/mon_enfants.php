<?php require_once 'includes/header_membre.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/mon_enfant.css">
    <title>mon enfant</title>
</head>
<body>
    <main>
        <section class="gauche">
            <div class="top">
                <img src="./images/fond_et_illustraction/illustration/Logo.png" alt="logo">
            </div>
            <div class="center">
                <div class="balise un">
                    <a href="">
                        <img src="./images/Personnages/monenfant/icon/utilisateur.png" alt="">
                        <p>Mon enfant</p>
                    </a>
                </div>
                <div class="balise">
                    <a href="Résultat_&_Bulletin.html">
                        <img src="./images/Personnages/monenfant/icon/notes.png" alt="">
                        <p>Résultat & Bulletin</p>
                     </a>
                </div>
                <div class="balise">
                    <a href="Emploi_du_Temps.html">
                        <img src="./images/Personnages/monenfant/icon/calendrier.png" alt="">
                        <p>Emploi du Temps</p>
                    </a>
                </div>
                <div class="balise">
                    <a href="Documents_officiels.html">
                        <img src="./images/Personnages/monenfant/icon/collection.png" alt="">
                        <p>Documents officiels</p>
                    </a>
                </div>
                <div class="balise">
                    <a href="Messagerie.html">
                        <img src="./images/Personnages/monenfant/icon/utilisateur.png" alt="">
                        <p>Messagerie</p>
                    </a>
                </div>
                <div class="balise">
                    <a href="Agenda_scolaire.html">
                        <img src="./images/Personnages/monenfant/icon/agenda.png" alt="">
                        <p>Agenda scolaire</p>
                    </a>
                </div>
                <div class="balise">
                    <a href="Paiements_&_factures.html">
                        <img src="./images/Personnages/monenfant/icon/billets-dargent.png" alt="">
                        <p>Paiements & factures</p>
                    </a>
                </div>
            </div>
            <div class="bottom">
                <div class="resaux">
                    <a href="www.facebook.com"><img src="./images/Personnages/monenfant/icon/facebook.png" alt="facebook"></a>
                    <a href="www.linkedin.com"><img src="./images/Personnages/monenfant/icon/logo-linkedin.png" alt="facebook"></a>
                    <a href="www.youtube.com"><img src="./images/Personnages/monenfant/icon/youtube.png" alt="facebook"></a>
                    <a href="www.instagram.com"><img src="./images/Personnages/monenfant/icon/instagram.png" alt="facebook"></a>
                </div>
            </div>

        </section>
        <section class="centre">
            <?php require_once 'includes/topbar.php' ?>
            <div class="centrer">
                <section id="gauche">
                    <div class="profils">

                        <div class="photo_de_larticle">
                            <img src="./images/Personnages/monenfant/choix/eleve.jpeg" alt="">
                        </div>
                        <div class="informations">
                            <h2>Junior Kayembe </h2>                
                            <div class="detail">
                                <div class="balise">
                                    <img src="./images/Personnages/monenfant/icon/classe (1).png" alt=""> 
                                    <p>Classe : 6e Primaire</p>
                                </div>
                                <div class="balise">
                                    <img src="./images/Personnages/monenfant/icon/moyenne.png" alt="">
                                    <p>Moyenne Générale : 78%</p>
                                </div>
                                <div class="balise">
                                    <img src="./images/Personnages/monenfant/icon/prix.png" alt="">
                                    <p>Mention : Assez Bien</p>
                                </div>
                                <div class="balise">
                                    <img src="./images/Personnages/monenfant/icon/identifiant.png" alt="">
                                    <p>Matricule : 02-0001</p>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class=" agenda">
                        <div class="balise">
                            <img src="./images/Personnages/monenfant/icon/agenda2.png" alt="">
                            <h1>Agenda Scolaire</h1>
                        </div>
                        <div class="contenue">
                            <div class="event">
                                <h4>Examen de Mathématiques <span class="badge badge-examen">Examen</span></h4>
                                <p>10 mai 2025 | 08:00</p>
                                <p>Chapitres 3 à 5 - Salle B2</p>
                              </div>
                        </div>
                    </div>
                    <div class="agenda ">
                        <div class="balise">
                            <img src="./images/Personnages/monenfant/icon/dossiers.png" alt="">
                            <h1>Documents Officiels</h1>
                        </div>
                        <div class="contenue">
                            <div class="doc">
                                <h4>Bulletin Premiere Semestre </h4>
                                <div class="download-section">
                                  <a href="MES RESULTATS SUR CISNET.pdf" class="download-btn">📥 Télécharger le bulletin PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="droite">
                    <div class="titre">
                        <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                        <h1>Liste de Cours</h1>
                        
                    </div>
                    <hr>
                    <div class="Conteneur_cours">
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                        <div class="cours">
                            <div class="titre_cours">
                                <img src="./images/Personnages/monenfant/icon/open-book.png" alt="">
                                <h3>Français</h3>
                            </div>
                            <p>Contenu : </p>
                            <ul>
                                <li>Lecture et compréhension - Grammaire et orthographe </li>
                                <li> Conjugaison - Expression écrite et orale</li>
                            </ul>
                        </div>
                    </div>
                
                </section>
            </div>
        </section>
    </main>
</body>
</html>