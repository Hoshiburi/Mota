<?php get_header(); ?>

<main>
    <div id="hero">
        <img class="hero-title" src="<?php echo get_template_directory_uri(); ?>/assets/images/event.png" alt="Titre du header : PHOTOGRAPHE EVENT">

        <?php  
            $query_images_args = array(
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'post_status'    => 'inherit',
                'posts_per_page' => - 1,
            );
            // Création d'une nouvelle requête WordPress pour récupérer les images
            $query_images = new WP_Query( $query_images_args );
            // Initialisation d'un tableau pour stocker les informations sur les images
            $images = array();
            // Parcourt chaque image obtenue de la requête et stocke les informations
            foreach ( $query_images->posts as $image ) {
                $images[] = wp_get_attachment_image_src($image->ID, "header-size");
            }
            // Sélectionne un index d'image aléatoire
            $aleatoire = rand(0,  count($images) - 1);
            // Récupére l'attribut alt de l'image actuelle
            $alt_text = get_post_meta($query_images->posts[$aleatoire]->ID, '_wp_attachment_image_alt', true);
            // Affiche l'image aléatoire avec la classe "hero-header__img", l'attribut et la source
            echo '<img class="hero-img" alt="' . esc_attr($alt_text) . '" src="'. $images[$aleatoire][0] . '">';
        ?>
    </div>

    
</main>

<?php get_footer(); ?>
