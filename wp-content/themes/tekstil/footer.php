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
	
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="logo">
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_option('pn_logo_af'); ?></a><span><?php echo get_option('pn_logo_bf'); ?></span>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <?php
                            if (has_nav_menu('footer_first_menu')){
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer_first_menu',
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
                                    'items_wrap'      => '<ul>%3$s</ul>',
                                ) );
                            }
                        ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php
                            if (has_nav_menu('footer_second_menu')){
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer_second_menu',
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
                                    'items_wrap'      => '<ul>%3$s</ul>',
                                ));
                            }
                        ?>
                    </div>
                    <div class="col-12 col-md-4 phone-row">
                        <?php echo get_option('pn_phone'); ?>
                        <?php echo get_option('pn_social'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>