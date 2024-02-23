document.addEventListener('DOMContentLoaded', function() {
    var contactButtons = document.querySelectorAll('.contact_button, .contact_button_mobile');
    var contactPopup = document.getElementById('contact_popup');
    var body = document.body; // Sélectionne l'élément body du document

    contactButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            contactPopup.classList.add('active');
            body.classList.add('no-scroll'); // Ajoute une classe pour bloquer le défilement
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('overlay')) {
            contactPopup.classList.remove('active');
            body.classList.remove('no-scroll'); // Supprime la classe pour réactiver le défilement
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.keyCode === 27 && contactPopup.classList.contains('active')) {
            contactPopup.classList.remove('active');
            body.classList.remove('no-scroll'); // Supprime la classe pour réactiver le défilement
        }
    });


//MENU BURGER
var menuToggle = document.querySelector('.menu-toggle');
var overlay = document.querySelector('.overlay-menu-burger');
var body = document.body;
var contactPopup = document.getElementById('contact_popup');

menuToggle.addEventListener('click', function() {
    this.classList.toggle('active');
    overlay.classList.toggle('menu-open');
    // Si le menu burger est ouvert, affiche l'overlay et bloque le scroll
    if (overlay.classList.contains('menu-open')) {
        overlay.style.height = "100%";
        body.classList.add('no-scroll'); // Ajoute la classe pour bloquer le scroll
    } else {
        // Sinon, cache l'overlay et active le scroll
        overlay.style.height = "0";
        body.classList.remove('no-scroll'); 
    }
});


//POP-UP WITH REF IN single-photos.php
jQuery(function ($) {
    $(document).on('click', '.contact-btn', function(e) {
        e.preventDefault(); // Empêche l'ouverture du formulaire avant le pré-remplissage de la Réf.
        
        // Récupère la valeur de référence à partir de l'attribut data-reference du bouton
        var valeurChampACF = $(this).data('reference');
        console.log("Valeur champ ACF:", valeurChampACF); // Vérifie si la valeur est correctement récupérée
        
        // Convertit la valeur en majuscules
        var valeurEnMajuscules = valeurChampACF.toUpperCase();
        
        // Pré-remplit le champ du formulaire avec la valeur de référence en majuscules
        $('input[name="your-subject"]').val(valeurEnMajuscules);
        
        // Ouvre la modale en ajoutant la classe 'active'
        $('#contact_popup').addClass('active');
        
        // Bloque le défilement de la page
        $('body').addClass('no-scroll');
    });

    // Fermeture de la modale et réactivation du défilement
    $(document).on('click', '#contact_popup .close-btn, #contact_popup .overlay', function(e) {
        e.preventDefault();
        $('#contact_popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });

    // Fermeture de la modale avec la touche Échap et réactivation du défilement
    $(document).keyup(function(e) {
        if (e.key === "Escape") { // keyCode est obsolète
            $('#contact_popup').removeClass('active');
            $('body').removeClass('no-scroll');
        }
    });
});


// H2 DANS SINGLE PHOTOS
const titles = document.querySelectorAll('.details h2');
    titles.forEach(function(title) {
        let words = title.innerText.split(' ');
        // Vérifie si le dernier "mot" est un signe de ponctuation et le fusionne avec le mot précédent
        if (words.length > 1 && ['!', '.', ',', '?', ':', ';'].includes(words[words.length - 1])) {
            const lastWord = words[words.length - 2] + words[words.length - 1];
            // Recrée le tableau des mots sans le dernier élément de ponctuation
            words = [...words.slice(0, -2), lastWord];
        }

        if (words.length > 1) {
            const midPoint = Math.ceil(words.length / 2);
            const firstHalf = words.slice(0, midPoint).join(' ');
            const secondHalf = words.slice(midPoint).join(' ');

            title.innerHTML = `<span>${firstHalf}</span><span>${secondHalf}</span>`;
        }
    });


//NAV PHOTOS DANS SINGLE-PHOTOS
jQuery(function ($) {
    $(".post-navigation__previous-arrow").hover(
        function () {
          /* Pendant le survol, on change l'opacité pour afficher le container avec la miniature */
          $(".post-navigation__previous-thumbnail").css("opacity", 1);
          /* Au moment ou la souris quitte le survol */
        },
        function () {
          /* On remet l'opacité à 0 pour cacher la div de la miniature */
          $(".post-navigation__previous-thumbnail").css("opacity", 0);
        }
      );
      // Fléche suivante :
      $(".post-navigation__next-arrow").hover(
        function () {
          /* Pendant le survol, on change l'opacité pour afficher le container avec la miniature */
          $(".post-navigation__next-thumbnail img").css("opacity", 1);
          /* Au moment ou la souris quitte le survol */
        },
        function () {
          /* On remet l'opacité à 0 pour cacher la div de la miniature */
          $(".post-navigation__next-thumbnail img").css("opacity", 0);
        }
      );
});







});


