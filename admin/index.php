<?php require_once 'includes/header_admin.php'?>


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
                        <i class="fa-solid fa-child"></i> <!-- icône enfant -->
                        <p>Tableau de bord</p>
                    </a>
                </div>
                <div class="balise un">
                    <a href="matiere.php">
                        <i class="fa-solid fa-child"></i> <!-- icône enfant -->
                        <p>Matierè</p>
                    </a>
                </div>
                <div class="balise un">
                    <a href="galerie.php">
                        <i class="fa-solid fa-child"></i> <!-- icône enfant -->
                        <p>Galerie</p>
                    </a>
                </div>
                <div class="balise un">
                    <a href="http://localhost/onligne_school/membre/register.php">
                        <i class="fa-solid fa-child"></i> <!-- icône enfant -->
                        <p>Ajouter le membre</p>
                    </a>
                </div>

            <div class="bottom">
                <div class="resaux">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.youtube.com" target="_blank" rel="noopener">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
        </section>
         <section class="centre">
            <?php require_once 'includes/topbar_admin.php' ?>
            <div class="centrer">
            </div>
        </section>
    </main>
</body>
</html>