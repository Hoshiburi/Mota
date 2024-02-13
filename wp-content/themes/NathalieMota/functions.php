<?php 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
add_action( 'init', 'register_my_menus' );

function theme_enqueue_styles() {
    // Déclaration du fichier style.css à la racine du thème
     wp_enqueue_style( 'theme_style', get_stylesheet_uri() );
 }

function theme_enqueue_scripts() {
    // Activation de la version de jQuery qui est incluse dans WordPress
    wp_enqueue_script('jquery');
    // Déclaration du js principal
    wp_enqueue_script( 'theme_script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true);
}

//IMG SIZE
add_image_size( 'header-size', 1440, 962, true );

// Ajouter une classe personnalisée au lien "Contact" dans le menu
    function add_contact_button_class($atts, $item, $args) {
        if ($args->theme_location == 'main_menu' && $item->title == 'CONTACT') {
            $atts['class'] = 'contact_button';
        }
        return $atts;
    }
    add_filter('nav_menu_link_attributes', 'add_contact_button_class', 10, 3);
    


// Déclarer le modèle de page personnalisé pour le Custom Post Type "detail_photo"
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

