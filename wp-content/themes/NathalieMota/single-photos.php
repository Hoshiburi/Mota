<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <div class="first-container">
                <div class="details-container">
                    <div class="details">
                        <?php 
                            $titre = get_field('titre');
                            $reference = get_field('ref');
                            $categorie = get_field('categorie');
                            $format = get_field('format');
                            $type = get_field('type');
                            $annee = get_field('annee');
                            
                            if ($titre) echo '<h2>' . $titre . '</h2>';
                            if ($reference) echo '<p>Référence : ' . $reference . '</p>';
                            if ($categorie) echo '<p>Catégorie : ' . $categorie . '</p>';
                            if ($format) echo '<p>Format : ' . $format . '</p>';
                            if ($type) echo '<p>Type : ' . $type . '</p>';
                            if ($annee) echo '<p>Année : ' . $annee . '</p>';
                        ?>
                    </div>
                </div>
                <div class="photo-view">
                <?php
                    if (has_post_thumbnail()) {
                        echo '<div class="single-photo-card-wrapper">';
                        echo '<div class="featured-image">';
                        the_post_thumbnail('large');
                        echo '</div>';
                        ?>
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
                        <?php
                        echo '</div>';
                    }
                ?>

                </div>
            </div>

            <div class="center-container">
            <div class="post-contact">
                <p>Cette photo vous intéresse ?</p>
                <button class="contact-btn" data-reference="<?php the_field('ref'); ?>">Contact</button>
            </div>

            <div class="post__navigation">
                    <div class="post-navigation__previous-thumbnail">
                    <?php echo get_the_post_thumbnail( get_previous_post(), 'single-photo-thumbnail-size' ); ?> <!-- miniature post précedent -->
                    </div>
                    <div class="post-navigation__next-thumbnail">
                    <?php echo get_the_post_thumbnail( get_next_post(), 'single-photo-thumbnail-size' ); ?> <!-- miniature post suivant -->
                    </div>
                    <div class="post-navigation__arrows">
                        <div class="post-navigation__previous-arrow">
                        <?php previous_post_link(' %link', '&#10229;' ); ?> <!-- fléche post précedent -->
                        </div>
                        <div class="post-navigation__next-arrow">
                        <?php next_post_link(' %link', '&#10230;' ); ?> <!-- fléche post suivant -->
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('templates_parts/photo_block'); ?>

            <div class="button-container">
                <button class="all-photos-button" onclick="window.location='<?php echo esc_url(home_url('/')); ?>'">Toutes les photos</button>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
