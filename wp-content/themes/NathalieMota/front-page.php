<?php get_header(); ?>

<div id="hero">
    <img class="hero-title" src="<?php echo get_template_directory_uri(); ?>/assets/images/event.png" alt="Titre du header : PHOTOGRAPHE EVENT">

    <?php  
        $query_images_args = array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'post_status'    => 'inherit',
            'posts_per_page' => -1,
        );

        $query_images = new WP_Query( $query_images_args );
        $images = array();

        foreach ( $query_images->posts as $image ) {
            $images[] = wp_get_attachment_image_src($image->ID, "header-size");
        }

        $aleatoire = rand(0, count($images) - 1);
        $alt_text = get_post_meta($query_images->posts[$aleatoire]->ID, '_wp_attachment_image_alt', true);

        echo '<img class="hero-img" alt="' . esc_attr($alt_text) . '" src="'. $images[$aleatoire][0] . '">';
    ?>
</div>

<main id="primary" class="site-main">
<div class="filters">
    <div class="filters-container">
        <div class="filters-group">
        <div class="filter-div" id="category-filter-div" data-default-title="Catégories">
                <div class="filter-title-div">
                    <div class="filter-title">Catégories</div>
                    <div class="filter-arrow"></div>
                </div>
                <div class="filter-option empty selected" data-value=""></div>

                <?php
                $categories = get_terms('photo_category', array('hide_empty' => false));
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        echo '<div class="filter-option" data-value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</div>';
                    }
                }
                ?>
            </div>
            <div class="filter-div" id="format-filter-div" data-default-title="Format">
            <div class="filter-title-div">
                    <div class="filter-title">Format</div>
                    <div class="filter-arrow"></div>
                </div>
                <div class="filter-option empty selected" data-value=""></div>

                <?php
                $formats = get_terms('format', array('hide_empty' => false));
                if (!empty($formats)) {
                    foreach ($formats as $format) {
                        echo '<div class="filter-option" data-value="' . esc_attr($format->term_id) . '">' . esc_html($format->name) . '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="filter-div" id="sort-by-div" data-default-title="Trier par">
        <div class="filter-title-div">
                    <div class="filter-title">Trier par</div>
                    <div class="filter-arrow"></div>
                </div>
            <div class="filter-option empty selected" data-value=""></div>

            <div class="filter-option" data-value="date-desc">Dès plus récentes</div>
            <div class="filter-option" data-value="date-asc">Dès plus anciennes</div>
        </div>
    </div>
</div>



<div class="all-photo-list">
    <?php 
    $related_args = array(
        'post_type' => 'detail_photo',
        'posts_per_page' => 12,
    );
    $related_query = new WP_Query($related_args);

    if ($related_query->have_posts()) :
        while ($related_query->have_posts()) : $related_query->the_post();
    ?>
        <div class="photo-card-wrapper">
            <?php if (has_post_thumbnail()) : ?>
                <div class="photo-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('photo-card-size'); ?>
                    </a>
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
                </div>
            <?php endif; ?>
        </div>
    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>



<div class="load-more-container"> 
    <button id="load-more" class="load-more-btn">Charger plus</button>
</div>
    
</main>

<?php get_footer(); ?>

