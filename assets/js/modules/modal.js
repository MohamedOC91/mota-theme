function initializeModal() {
    // Sélection des boutons de contact dans le menu et sur la page
    const contactBtns = jQuery(".menu-item-116 a, .contact-btn");
    
    // Sélection du formulaire modal
    const modalForm = jQuery(".modal-overlay");
    
    // Sélection du contenu spécifique du modal
    const modalContent = jQuery("#wpcf7-f99-o1");
    
    // Sélection du conteneur pour la référence
    const formRefDiv = jQuery(".wpcf7-form-control-wrap");

    // Ajout d'un gestionnaire d'événements au clic sur les boutons de contact
    contactBtns.click(openForm);

    function openForm(event) {
        event.preventDefault();

        // Récupération de la valeur de référence
        const refValueElement = jQuery(".ref-value");
        if (refValueElement.length) {
            const refValue = refValueElement.text();

            // Remplissage du champ de formulaire avec la référence en majuscules
            const inputField = formRefDiv.find("input[name='your-subject']");
            if (inputField.length) {
                inputField.val(refValue.toUpperCase());
            }
        }

        // Ajout de la classe "active" pour afficher le modal
        modalForm.addClass("active");

        // Ajout d'un gestionnaire d'événements pour fermer le modal en cliquant à l'extérieur
        jQuery(document).click(closeFormOutside);
    }

    function closeFormOutside(event) {
        // Vérification du clic en dehors du contenu du modal et des boutons de contact
        if (!jQuery(event.target).closest(modalContent).length && !contactBtns.toArray().includes(event.target)) {
            // Retrait de la classe "active" pour masquer le modal
            modalForm.removeClass("active");
            // Désabonnement du gestionnaire d'événements de clic en dehors du modal
            jQuery(document).unbind("click", closeFormOutside);
        }
    }
}
