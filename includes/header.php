<header>
    <div class="barnoir">
        <div class="logo">
            <img src="./images/fond_et_illustraction/illustration/Logo.png" alt="logo">
        </div>

        <!-- BOUTON MENU HAMBURGER -->
    </div>

    <div class="barblanche">
        <div class="menu-toggle" id="menu-toggle">
            <img src="./images/fond_et_illustraction/illustration/icon/menu.png" alt="Menu">
        </div>

        <nav id="navbar">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="a_propos.php">À propos</a></li>
                <li><a href="equipe.php">Équipe Pédagogique</a></li>
                <li><a href="actualite.php">Actualité</a></li>
                <li><a href="http://localhost/onligne_school/mon_enfant/login.php">Mon enfant</a></li>
            </ul>
            <div class="button_lien">
                <a href="http://localhost/onligne_school/mon_enfant/login.php">Connexion</a>
            </div>
        </nav>
    </div>
</header>
<style>
.menu-toggle {
    display: none;
    cursor: pointer;
    padding: 10px;
    z-index: 1001;
}
.menu-toggle img {
    width: 30px;
}


/* --- RESPONSIVE --- */
@media screen and (max-width: 600px) {
    .menu-toggle {
        display: block;
        position: absolute;
        top: 15px;
        right: 20px;
    }
    .barnoir {
        padding: 10px;
    }
    .barblanche {
        height: auto;
    }
    .barblanche nav {
        position: relative;
    }

    .barblanche nav ul {
        
    }

    .barblanche nav ul.show {
        display: block;
    }

    .button_lien {
        display: none;
    }
}

</style>
<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const navLinks = document.querySelector('#navbar ul');

    toggleBtn.addEventListener('click', () => {
        navLinks.classList.toggle('show');
    });
</script>
