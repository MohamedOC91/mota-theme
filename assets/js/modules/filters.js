// FILTERS

function initializeFilters() {
    // Initialisation des valeurs des filtres actifs
    let activeCategory = 'all'; // Catégorie active par défaut
    let activeFormat = 'all';   // Format actif par défaut
    let activeSortByDate = 'all'; // Tri par date actif par défaut

    // Définition des valeurs par défaut des sélecteurs de filtres sur la page
    jQuery('#categories').val(activeCategory);
    jQuery('#formats').val(activeFormat);
    jQuery('#sort-by-date').val(activeSortByDate);

    // Fonction pour vérifier si des filtres sont actifs
    function areFiltersActive() {
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    // Gestionnaire d'événements pour les changements de filtres
    jQuery('#categories, #formats, #sort-by-date').on('change', function() {
        ajaxFilter(); // Appel de la fonction de filtrage AJAX lorsqu'un filtre change
    });

    // Fonction de filtrage AJAX
    function ajaxFilter() {
        // Récupération des valeurs des filtres sélectionnés
        let category = jQuery('#categories').val();
        let format = jQuery('#formats').val();
        let sortByDate = jQuery('#sort-by-date').val();

        // Mise à jour des filtres actifs
        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        // Masquage du bouton "Load More" si des filtres sont actifs
        if (areFiltersActive()) {
            jQuery('#load-more').hide();
        }

        // Envoi de la requête AJAX pour filtrer le contenu de la galerie
        jQuery.ajax({
            type: 'POST',
            url: './wp-admin/admin-ajax.php',
            data: {
                action: 'ajaxFilter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {
                jQuery('.gallery-container').html(response);

                // Affichage du bouton "Load More" si aucun filtre n'est actif
            }
        });
    }
}
