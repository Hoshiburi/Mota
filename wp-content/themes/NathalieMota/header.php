<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo">
            </div>
        </a>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'menu_id'     => 'main',
            ) );
        ?>

    <!-- menu mobile en overlay-->
    

</header>
