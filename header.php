<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota - Photographe Event</title>
    <?php wp_head(); ?> <!-- Inclut les feuilles de style et les scripts définis par WordPress -->
</head>
<body>
    <?php wp_body_open(); ?> <!-- Permet aux plugins et thèmes de WordPress d'ajouter du contenu juste après l'ouverture du corps de la page -->
    <header class="header">
        <?php
            // Vérifie si un logo personnalisé est défini dans le thème
            if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
            <!-- Si un logo personnalisé est défini, affiche-le en tant que lien vers la page d'accueil -->
            <a href="<?php echo home_url(); ?>">
                <img class="header__logo" src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
        <?php //
            else : ?>
                <!-- Si aucun logo personnalisé n'est défini, affiche le titre du site -->
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <?php endif;
        ?>
        <!-- Menu de navigation pour les écrans de bureau -->
        <div class="header__navDesktop">
            <?php wp_nav_menu(array('theme_location' => 'main')); ?>
        </div>
        <!-- Menu de navigation pour les appareils mobiles -->
        <div class="header__navMobile">
            <!-- Contenu du menu mobile -->
            <div id="menu_burger" class="nav_burger">
                <!-- Haut du menu mobile -->
                <div class="navMobile-top">
                    <?php
                    // Affiche le logo personnalisé s'il est défini, sinon affiche le titre du site
                    if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
                        <a href="<?php echo home_url(); ?>">
                            <img class=header__logo src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
                        </a>
                    <?php //
                    else : ?>
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <?php endif;
                    ?>
                    <!-- Bouton pour fermer le menu mobile -->
                    <a id="closeBtn" href="#" class="close">&times;</a>
                </div>
                <!-- Affiche le menu de navigation pour les appareils mobiles -->
                <?php wp_nav_menu(array('theme_location' => 'main')); ?>
            </div>
            <!-- Bouton burger pour activer/désactiver le menu mobile -->
            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
        </div>
    </header>
</body>
</html>
