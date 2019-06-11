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
            <div class="col-12 col-lg-3">
                <div class="logo">
                    <?php echo get_option('pn_logo'); ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
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
                                    'walker'          => new footer_menu(),
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
                                    'walker'          => new footer_menu(),
                                ));
                            }
                        ?>
                    </div>
                    <div class="col-12 col-md-4 phone-row">
                        <?php echo get_option('pn_phonefot'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>

<script type="text/javascript">
    var sevastopolMap, sevastopolPlacemark, sevastopolcoords;

    ymaps.ready(init);

    function init () {

        sevastopolMap = new ymaps.Map('sevastopol', {

            center: [<?php echo get_option('pn_coordinates'); ?>],

            zoom: 17

        });

        var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});

        sevastopolMap.controls

        //.add('zoomControl')

            .add('typeSelector')

        sevastopolcoords = [<?php echo get_option('pn_coordinates'); ?>];

        sevastopolPlacemark = new ymaps.Placemark([<?php echo get_option('pn_coordinates'); ?>],{}, {preset: "twirl#redIcon", draggable: true});

        sevastopolMap.geoObjects.add(sevastopolPlacemark);

    }
</script>

<?php wp_footer(); ?>

</body>
</html>