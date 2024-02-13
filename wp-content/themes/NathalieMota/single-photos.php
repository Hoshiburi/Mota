<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <div class="details">
                <?php 
                    // Récupérer et afficher les champs personnalisés ACF
                    $titre = get_field('titre');
                    $reference = get_field('reference');
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
                    
                    // Afficher l'image à la une si disponible
                    if (has_post_thumbnail()) {
                        echo '<div class="featured-image">';
                        the_post_thumbnail('large');
                        echo '</div>';
                    }
                ?>

                
            </div>

            <?php get_template_part('templates_parts/photo_block'); ?>

            <div class="button-container">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="all-photos-button">Toutes les photos</a>
            </div>

            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
