<?php
get_header();
?>

<div class="home-content">
    <!-- Section de la bannière du héros -->
    <div class="hero">
        <h1 class="hero__title">PHOTOGRAPHE EVENT</h1>
        <div class="hero__banner">
            <?php
            // Requête pour récupérer une photo aléatoire du type "photo" avec le format "paysage"
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => 'paysage',
                    ),
                ),
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <!-- Affichage de l'image de la bannière -->
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                endwhile;
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>

    <!-- Section de la galerie d'images -->
    <div class="gallery-home">
        <!-- Filtres de la galerie -->
        <div class="filters">
            <!-- Filtre par catégories et formats -->
            <div class="categories-formats">
                <!-- Filtre par catégories -->
                <div class="categories-filter">
                    <select id="categories" class="selector">
                        <option value="all" selected>CATÉGORIES</option>
                        <?php
                        $categories = get_terms(array(
                            "taxonomy" => "category",
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->slug . '">' . mb_convert_case($category->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- Filtre par formats -->
                <div class="formats-filter">
                    <select id="formats" class="selector">
                        <option value="all" selected>FORMATS</option>
                        <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format",
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Filtre par date -->
            <div class="sort-date">
                <select id="sort-by-date" class="selector">
                    <option value="all" selected>TRIER PAR</option>
                    <option value="DESC">Les Plus Récentes</option>
                    <option value="ASC">Les Plus Anciennes</option>
                </select>
            </div>
        </div>

        <!-- Conteneur de la galerie d'images -->
        <div class="gallery-container">
            <?php
            // Requête pour récupérer les images de type "photo"
            $paged = get_query_var( 'paged', 1 );
            $gallery = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'orderby' => 'date',
                'order' => 'ASC',
                'post_status' => 'publish',
                'paged' => $paged,
            );

            $query = new WP_Query($gallery);

            if ($query->have_posts()){
                while ($query->have_posts()) : $query->the_post();
                    // Inclusion d'un template pour afficher les blocs de photo
                    get_template_part('assets/template-parts/photo-block');
                endwhile;
            }
            ?>
        </div>

        <!-- Bouton pour charger plus d'images -->
        <div class="btn-container">
            <a id="load-more" href="<?php echo home_url('/'); ?>">
                <span class="btn more-btn">Charger plus</span>
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
?>
