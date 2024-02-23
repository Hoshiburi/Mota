<?php
// Template Name: Photo Block Template
?>
<div class="container-more-photo">
    <h3 class="related-photos-title">VOUS AIMEREZ AUSSI</h3>
    <div class="related-photos-list">
        <?php 
            $related_args = array(
                'post_type' => 'detail_photo',
                'posts_per_page' => 2,
                'post__not_in' => array( get_the_ID() ),
                'meta_query' => array(
                    array(
                        'key'     => 'categorie', 
                        'value'   => get_field('categorie'), 
                        'compare' => 'IN',
                    ),
                ),
            );
            $related_query = new WP_Query( $related_args );
            
            if ( $related_query->have_posts() ) :
                while ( $related_query->have_posts() ) :
                    $related_query->the_post();
        ?>
                    <div class="related-photo">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('photo-card-size'); ?>
                                <div class="overlay">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Voir" class="icon-eye"></a>
                                    <a href="#" class="icon-fullscreen-trigger" data-lightbox="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-name="<?php the_title(); ?>" data-category="<?php echo get_field('categorie'); ?>" data-ref="<?php echo get_field('ref'); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_fullscreen.png" alt="Plein écran" class="icon-fullscreen">
                                    </a>
                                    <div class="photo-info">
                                        <span class="photo-ref"><?php echo get_field('ref'); ?></span>
                                        <span class="photo-categorie"><?php echo get_field('categorie'); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
        <?php 
                endwhile;
            endif; 
            wp_reset_postdata(); 
        ?>
    </div>
</div>
