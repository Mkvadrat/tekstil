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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo pn_wp_title('','|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php wp_head(); ?>
</head>
<body>

<header>
    <div class="container">
        <div class="top-navbar">
            <div class="left-top-nav">
                <div class="logo">
                     <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img
                            src="<?php header_image(); ?>"
                            height="<?php echo get_custom_header()->height; ?>"
                            width="<?php echo get_custom_header()->width; ?>"
                            alt=""
                        />
                    </a>
                </div>
                <div class="address-block">
                    <div class="address"><?php echo get_option('pn_address'); ?></div>
                    <p><?php echo get_option('pn_mark'); ?></p>
                </div>
            </div>
            <div class="right-top-nav">
                <?php echo get_option('pn_callback'); ?>
                <div class="phones-block">
                    <div class="phones">
                        <?php echo get_option('pn_phone'); ?>
                    </div>
                    <p><?php echo get_option('pn_work'); ?></p>
                </div>
            </div>
        </div>
        <hr/>
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
                    'items_wrap'      => '<ul class="navbar">%3$s</ul>',
                    'walker'          => new header_menu(),
                ) );
            }
        ?>
    </div>
</header>