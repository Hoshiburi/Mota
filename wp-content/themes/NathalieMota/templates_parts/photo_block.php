<?php
// Template Name: Photo Block Template
?>
<div class="container-more-photo">
    <h3 class="related-photos-title">VOUS AIMEREZ AUSSI</h3>
    <div class="related-photos-list">
        <?php 
            // Récupérer les articles de la même catégorie
            $related_args = array(
                'post_type' => 'detail_photo',
                'posts_per_page' => 2,
                'post__not_in' => array( get_the_ID() ), // Exclure l'article actuel
                'meta_query' => array(
                    array(
                        'key'     => 'categorie', 
                        'value'   => get_field('categorie'), 
                        'compare' => 'IN',
                    ),
                ),
            );
            $related_query = new WP_Query( $related_args );
            
            // Boucle pour afficher les articles apparentés
            if ( $related_query->have_posts() ) :
                while ( $related_query->have_posts() ) :
                    $related_query->the_post();
        ?>
                    <div class="related-photo">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('photo-card-size'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
        <?php 
                endwhile; 
            endif; 
            wp_reset_postdata(); 
        ?>
    </div>