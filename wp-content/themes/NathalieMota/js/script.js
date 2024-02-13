document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne l'élément avec la classe contact_button
    var contactButton = document.querySelector('.contact_button');
    // Sélectionne l'élément avec l'ID contact_popup
    var contactPopup = document.getElementById('contact_popup');

    // Si l'élément avec la classe contact_button est cliqué
    contactButton.addEventListener('click', function(e) {
        // Empêche le comportement par défaut du lien
        e.preventDefault();

        // Affiche la modale en ajoutant la classe 'active'
        contactPopup.classList.add('active');
    });

    // Si l'utilisateur clique sur la zone de superposition
    document.addEventListener('click', function(e) {
        // Si l'élément cliqué est l'élément avec la classe overlay
        if (e.target.classList.contains('overlay')) {
            // Masque la modale en supprimant la classe 'active'
            contactPopup.classList.remove('active');
        }
    });

    // Si l'utilisateur appuie sur la touche "Échap" (27)
    document.addEventListener('keyup', function(e) {
        // Si la touche "Échap" est appuyée et que la modale est ouverte
        if (e.key === "Escape" && contactPopup.classList.contains('active')) {
            // Masque la modale en supprimant la classe 'active'
            contactPopup.classList.remove('active');
        }
    });
});


