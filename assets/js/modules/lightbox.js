function initializeLightbox() {
    jQuery(document).on('click', '.fullsize', function() {
        openLightbox(jQuery(this).closest('.photo-suggested'));
    });


// Sélection des éléments de la lightbox
const lightbox = jQuery(".lightbox");
const closeIcon = jQuery(".lightbox__close");
const prevButton = jQuery(".lightbox__prev");
const nextButton = jQuery(".lightbox__next");

let currentIndex = 0; // Suivi de l'index de la photo actuellement affichée

// Lorsqu'on clique sur l'icône de fermeture, appeler la fonction de fermeture
closeIcon.click(closeLightbox);
// Lorsqu'on clique sur le bouton précédent, appeler la fonction pour afficher la photo précédente
prevButton.click(showPreviousPhoto);
// Lorsqu'on clique sur le bouton suivant, appeler la fonction pour afficher la photo suivante
nextButton.click(showNextPhoto);

// Fonction pour ouvrir la lightbox
function openLightbox(photo) {
    // Récupérer l'URL de la photo, la référence et la catégorie à partir des attributs de données de la photo
    const photoSrc = photo.data('photo-src');
    const photoref = photo.data('photo-ref');
    const photoCategory = photo.data('photo-category');

    // Mettre à jour l'URL de la photo, la référence et la catégorie dans la lightbox
    jQuery('.lightbox-photo').attr('src', photoSrc);
    jQuery('.lightbox__ref').text(photoref);
    jQuery('.lightbox__category').text(photoCategory);

    // Mettre à jour l'index actuel avec l'index de la photo cliquée
    currentIndex = jQuery(".photo-suggested").index(photo);

    // Ajouter la classe "active" pour afficher la lightbox
    lightbox.addClass("active");
}

// Fonction pour fermer la lightbox
function closeLightbox() {
    // Supprimer la classe "active" pour masquer la lightbox
    lightbox.removeClass("active");
}

// Fonction pour afficher la photo précédente
function showPreviousPhoto() {
    // Mettre à jour l'index pour afficher la photo précédente
    currentIndex = (currentIndex - 1 + jQuery(".photo-suggested").length) % jQuery(".photo-suggested").length;

    // Récupérer la photo à l'index mis à jour
    const prevPhoto = jQuery(".photo-suggested").eq(currentIndex);

    // Afficher les informations de la photo précédente dans la lightbox
    openLightbox(prevPhoto);
}

// Fonction pour afficher la photo suivante
function showNextPhoto() {
    // Mettre à jour l'index pour afficher la photo suivante
    currentIndex = (currentIndex + 1) % jQuery(".photo-suggested").length;

    // Récupérer la photo à l'index mis à jour
    const nextPhoto = jQuery(".photo-suggested").eq(currentIndex);

    // Afficher les informations de la photo suivante dans la lightbox
    openLightbox(nextPhoto);
}

}