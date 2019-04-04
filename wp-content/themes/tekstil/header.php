<?php
/*
Theme Name: Tekstil
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Tekstil
Version: 1.0
*/
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->

<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8">
    <title><?php echo pn_wp_title('','|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php wp_head(); ?>
</head>
<body>
      
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="logo"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img
                src="<?php header_image(); ?>"
                height="<?php echo get_custom_header()->height; ?>"
                width="<?php echo get_custom_header()->width; ?>"
                alt=""
            />
            </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <?php
                    if (has_nav_menu('header_menu')){
                        wp_nav_menu( array(
                            'theme_location'  => 'header_menu',
                            'menu'            => '',
                            'container'       => false,
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => '',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul class="navbar-nav ml-auto">%3$s</ul>',
                            'walker'          => new header_menu(),
                        ) );
                    }
                ?>
            </div>
        </nav>
    </div>
</header>