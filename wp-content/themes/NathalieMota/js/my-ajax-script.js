jQuery(document).ready(function($) {
    // Gestion de l'affichage des options de filtre au clic
    $('.filter-div').on('click', function(e) {
        e.stopPropagation(); // Empêche le clic de se propager
        $(this).find('.filter-option').toggle(); // Bascule l'affichage des options
        $(this).toggleClass('is-open'); // Ajoute ou retire la classe is-open pour gérer le style de bordure
    });

    // Ferme les options de filtre si on clique en dehors
    $(document).on('click', function() {
        $('.filter-option').hide();
        $('.filter-div').removeClass('is-open'); 
    });

    // Empêche la fermeture lors du clic sur une option
    $('.filter-option').on('click', function(e) {
        e.stopPropagation();
    });

    // Mise à jour du titre du filtre avec l'option sélectionnée ou réinitialisation
    $('.filter-option').click(function() {
        var selectedOptionText = $(this).text(); // Récupère le texte de l'option sélectionnée
        var filterDiv = $(this).closest('.filter-div');
        var defaultTitle = filterDiv.attr('data-default-title'); // Utilise attr pour récupérer l'attribut
    
        if($(this).hasClass('empty')) { // Vérifie si l'option sélectionnée est l'option vide
            filterDiv.find('.filter-title').text(defaultTitle); // Réinitialise le titre avec la valeur par défaut
        } else {
            filterDiv.find('.filter-title').text(selectedOptionText.toUpperCase()); // Met à jour le titre et transforme en majuscules
        }
    
        $(this).parent().find('.filter-option').removeClass('selected'); // Désélectionne les autres options
        $(this).addClass('selected'); // Sélectionne l'option cliquée
        $('.filter-option').hide(); // Ferme le menu déroulant après la sélection
        filterDiv.removeClass('is-open'); // Retire la classe is-open puisque le menu se ferme
    });
    

    function reapplyOverlayListeners() {
        jQuery('.icon-fullscreen-trigger').off('click').on('click', function(e) {
            e.preventDefault();
        });
    }
    
    // Fonction pour gérer le changement de filtre et le rechargement initial des photos
    function updateFilters() {
        var categoryFilter = $('#category-filter-div .selected').data('value') || '';
        var formatFilter = $('#format-filter-div .selected').data('value') || '';
        var sortBy = $('#sort-by-div .selected').data('value') || '';
        currentPage = 1; // Réinitialiser la pagination à la première page lors du changement de filtre

        $.ajax({
            url: my_ajax_obj.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'filter_photos',
                nonce: my_ajax_obj.nonce,
                category_filter: categoryFilter,
                format_filter: formatFilter,
                sort_by: sortBy,
                page: currentPage
            },
            success: function(response) {
                $('.all-photo-list').html(response.html);
                if (!response.hasMore) {
                    $('#load-more').hide();
                } else {
                    $('#load-more').show();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Gestion des clics sur les options de filtre pour la sélection et le filtrage
    $('.filter-option').click(function() {
        $(this).parent().find('.filter-option').removeClass('selected'); // Désélectionne les autres options
        $(this).addClass('selected'); // Sélectionne l'option cliquée
        $('.filter-option').hide(); // Ferme le menu déroulant après la sélection
        updateFilters(); // Met à jour les photos selon les filtres sélectionnés
    });

    // Pagination et chargement de plus de photos
    var currentPage = 1;
    $('#load-more').click(function() {
        var categoryFilter = $('#category-filter-div .selected').data('value') || '';
        var formatFilter = $('#format-filter-div .selected').data('value') || '';
        var sortBy = $('#sort-by-div .selected').data('value') || '';

        $.ajax({
            url: my_ajax_obj.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'filter_photos',
                nonce: my_ajax_obj.nonce,
                category_filter: categoryFilter,
                format_filter: formatFilter,
                sort_by: sortBy,
                page: ++currentPage
            },
            success: function(response) {
                if (response.html.trim() !== '') {
                    $('.all-photo-list').append(response.html);
                }
                if (!response.hasMore) {
                    $('#load-more').hide();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
