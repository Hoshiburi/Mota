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
<div class="header">
<div class="header-container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div>
                <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo">
            </div>
        </a>
    <div class="menu-desktop">
        <?php wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'menu_id'     => 'main',
            ) ); ?>
    </div>
    <!-- menu mobile en overlay-->
    <div class="menu-mobile">
        <div class="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>  
    <div class="overlay-menu-burger">
        <div class="menu-content">
            <?php wp_nav_menu(array(
                'theme_location' => 'menu_mobile',
                'menu_id'     => 'main_mobile',
            ) ); ?>
        </div>
    </div>
    </div>
</div>
</div>
</header>
