<?php
// Enqueue des scripts et styles
function theme_enqueue_scripts() {
    wp_enqueue_script('jquery');

    wp_enqueue_script('theme_script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);

    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
    
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/js/my-ajax-script.js', array('jquery'), null, true);
    wp_localize_script('my-ajax-script', 'my_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('my_ajax_nonce'),
    ));
    
    wp_enqueue_style('theme_style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// AJOUT DES ACTIONS AJAX
add_action('wp_ajax_filter_photos', 'filter_photos_function');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_function');

function filter_photos_function() {
    check_ajax_referer('my_ajax_nonce', 'nonce'); // Vérification du nonce pour la sécurité

    $page = isset($_POST['page']) ? absint($_POST['page']) : 1; // Gestion de la pagination
    $posts_per_page = 12; // Nombre de posts par page

    // Récupération des filtres
    $category_filter = isset($_POST['category_filter']) ? $_POST['category_filter'] : '';
    $format_filter = isset($_POST['format_filter']) ? $_POST['format_filter'] : '';
    $sort_order = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'date-desc';

    $args = array(
        'post_type' => 'detail_photo', // Assurez-vous que le type de post correspond à votre cas d'usage
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
    );

    // Construction de la requête tax_query si les filtres sont appliqués
    if (!empty($category_filter) || !empty($format_filter)) {
        $args['tax_query'] = array('relation' => 'AND');

        if (!empty($category_filter)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'photo_category',
                'field'    => 'term_id',
                'terms'    => array( $category_filter ),
            );
        }

        if (!empty($format_filter)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field'    => 'term_id',
                'terms'    => array( $format_filter ),
            );
        }
    }

    // Configuration de l'ordre de tri
    switch ($sort_order) {
        case 'date-desc':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'date-asc':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        // Ajoutez d'autres cas de tri si nécessaire
    }

    $query = new WP_Query($args);
    $output = '';
    $has_more = false;

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Assurez-vous d'ajouter toutes les informations nécessaires pour l'overlay ici
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'photo-card-size');
            $permalink = get_the_permalink();
            $category = get_field('categorie'); // Assurez-vous que cela correspond à votre structure
            $ref = get_field('ref'); // Idem
    
            $output .= '<div class="photo-card-wrapper">';
            $output .= '<a href="' . esc_url($permalink) . '">';
            $output .= '<img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '">';
            $output .= '</a>';
            $output .= '<div class="overlay">';
            $output .= '<a href="' . esc_url($permalink) . '"><img src="' . get_template_directory_uri() . '/assets/images/icon_eye.png" alt="Voir" class="icon-eye"></a>';
            $output .= '<a href="#" class="icon-fullscreen-trigger" data-lightbox="' . esc_url($image_url) . '" data-name="' . get_the_title() . '" data-category="' . esc_attr($category) . '" data-ref="' . esc_attr($ref) . '">';
            $output .= '<img src="' . get_template_directory_uri() . '/assets/images/icon_fullscreen.png" alt="Plein écran" class="icon-fullscreen"></a>';
            $output .= '<div class="photo-info">';
            $output .= '<span class="photo-ref">' . esc_html($ref) . '</span>';
            $output .= '<span class="photo-categorie">' . esc_html($category) . '</span>';
            $output .= '</div></div></div>';
        }
        $has_more = $query->max_num_pages > $page;
    } else {
        $output = '<div class="no-results">Aucune photo trouvée.</div>';
    }
    
    wp_send_json(array(
        'html' => $output,
        'hasMore' => $has_more
    ));

    wp_die(); // Termine correctement la requête AJAX
}


// TAILLES IMG 
add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes() {
    add_image_size( 'header-size', 1440, 962, true );
    add_image_size( 'photo-card-size', 564, 495, true );
    add_image_size( 'single-photo-thumbnail-size', 81, 71, true ); 
}


//MENUS
function my_theme_register_nav_menus() {
    register_nav_menus( array(
        'main_menu' => __('Main Menu', 'text-domain'),
        'menu_mobile' => __('Mobile Menu', 'text-domain'),
    ) );
}
add_action( 'after_setup_theme', 'my_theme_register_nav_menus' );


// AJOUT CLASS CSS CONTACT DANS MENU
add_filter('nav_menu_link_attributes', 'add_contact_button_class', 10, 3);
function add_contact_button_class($atts, $item, $args) {
    // Vérifie si l'emplacement du menu est 'main_menu' et le titre de l'élément est 'CONTACT'
    if ($args->theme_location == 'main_menu' && $item->title == 'CONTACT') {
        $atts['class'] = 'contact_button'; // Ajoute la classe 'contact_button'
    }
    return $atts; // Retourne les attributs modifiés
}

add_filter('nav_menu_link_attributes', 'add_contact_button_mobile_class', 10, 3);
function add_contact_button_mobile_class($atts, $item, $args) {
    // Vérifie si l'emplacement du menu est 'menu_mobile' et le titre de l'élément est 'CONTACT'
    if ($args->theme_location == 'menu_mobile' && $item->title == 'CONTACT') {
        $atts['class'] = 'contact_button_mobile'; // Ajoute la classe 'contact_button_mobile'
    }
    return $atts; // Retourne les attributs modifiés
}


// Déclarer le modèle de page personnalisé pour le CPT "detail_photo"
add_filter( 'template_include', 'custom_detail_photo_template', 99 );
function custom_detail_photo_template( $template ) {
    // Vérifier si la requête actuelle concerne un article de type "detail_photo"
    if ( is_singular( 'detail_photo' ) ) {
        // Charger le fichier single-photos.php depuis le répertoire du thème
        $new_template = locate_template( array( 'single-photos.php' ) );
        if ( ! empty( $new_template ) ) {
            return $new_template;
        }
    }
    return $template;
}

// Modifier les classes des formulaires Contact Form 7
add_filter( 'wpcf7_form_elements', 'custom_wpcf7_form_elements' );
function custom_wpcf7_form_elements( $form ) {
    
    $form = str_replace( 'class="wpcf7-form-control wpcf7-submit', 'class="wpcf7-form-control wpcf7-submit btn-submit has-spinner', $form );
    $form = str_replace( 'class="wpcf7-form-control wpcf7-text', 'class="wpcf7-form-control wpcf7-text form-control', $form );
    $form = str_replace( 'class="wpcf7-form-control wpcf7-email', 'class="wpcf7-form-control wpcf7-email form-control', $form );
    
    return $form;
}
