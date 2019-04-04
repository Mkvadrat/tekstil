<?php
/*
Theme Name: Tekstil
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Tekstil
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function tl_scripts(){
	wp_register_style( 'fonts-css', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=cyrillic');
    wp_enqueue_style( 'fonts-css' );
	
	wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style( 'bootstrap-css' );
	
	wp_register_style( 'carousel-css', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style( 'carousel-css' );
	
	wp_register_style( 'style-css', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'style-css' );
	
	wp_register_style( 'responsive-css', get_template_directory_uri() . '/css/responsive.css'); 
    wp_enqueue_style( 'responsive-css' );
	
	if (!is_admin()) {
		wp_enqueue_script( 'jquery-min', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', '', true );
		//wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/jquery-2.1.1.min.js', '', '', true );
		wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.bundle.js', '', '', true );
		wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', '', '', true );
		wp_enqueue_script( 'common-min', get_template_directory_uri() . '/js/common.js', '', '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'tl_scripts' );

//Регистрируем название сайта
function pn_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ug' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'psy_wp_title', 10, 2 );

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

//Изображение в шапке сайта
$args = array(
	'width'         => 292,
	'height'        => 154,
	'default-image' => get_template_directory_uri() . '/images/logo_default.png',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'header_menu'  => 'Меню в шапке',
		  'footer_first_menu' => 'Меню в подвале (1)',
		  'footer_second_menu' => 'Меню в подвале (2)',
		)
	);
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************МЕНЮ САЙТА*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// Добавляем свой класс для пунктов меню:
class header_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '<ul class="submenu">' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '<ul class="subsubmenu">' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '<ul class="subsubsubmenu">' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth, $args ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '<li class="nav-item">';

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a class="nav-link anchor" href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a class="nav-link anchor" href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a class="nav-link anchor" href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a class="nav-link anchor" href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Добавляем свой класс для пунктов меню:
class footer_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '<ul class="submenu">' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '<ul class="subsubmenu">' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '<ul class="subsubsubmenu">' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth, $args ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '<li>';

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a class="anchor" href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a class="anchor" href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a class="anchor" href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a class="anchor" href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод изображения для плагина nextgen-gallery
function getNextGallery($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta AS pm JOIN $wpdb->posts AS p ON (pm.post_id = p.ID) AND (pm.post_id = %s) AND meta_key = %s ORDER BY pm.post_id DESC LIMIT 1", $post_id, $meta_key) );
	
	$unserialize_value = unserialize($value);
	
	return $unserialize_value;	
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*************************************************************************НАСТРОЙКИ*************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

	//create new top-level menu
	add_menu_page('ТЕК «Стиль» настройки темы', 'ТЕК «Стиль» настройки темы', 'administrator', __FILE__, 'baw_settings_page','dashicons-id-alt');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	/*register_setting( 'baw-settings-group', 'pn_logo_a' );
	register_setting( 'baw-settings-group', 'pn_logo_b' );*/

	register_setting( 'baw-settings-group', 'pn_logo_af' );
	register_setting( 'baw-settings-group', 'pn_logo_bf' );
	register_setting( 'baw-settings-group', 'pn_phone' );
	register_setting( 'baw-settings-group', 'pn_social' );
	register_setting( 'baw-settings-group', 'pn_maps' );
}

function baw_settings_page() {
?>
<div class="wrap">
<h2>Настройки темы ТЕК «Стиль»</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <table class="form-table">
        <!--<tr valign="top">
		<td colspan="2"><h3>Настройки шапки сайта</h3></td>
		</tr>
		<tr valign="top">
        <th scope="row">Логотип 1</th>
		<td><input type="text" name="pn_logo_a" value="<?php echo get_option('pn_logo_a'); ?>" size="152" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Логотип 2</th>
        <td><input type="text" name="pn_logo_b" value="<?php echo get_option('pn_logo_b'); ?>" size="152" /></td>
        </tr>-->
		
		<tr valign="top">
		<td colspan="2"><h3>Настройки подвала сайта</h3></td>
		</tr>
		<tr valign="top">
        <th scope="row">Логотип 1</th>
        <td><input type="text" name="pn_logo_af" value="<?php echo get_option('pn_logo_af'); ?>" size="152" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Логотип 2</th>
        <td><input type="text" name="pn_logo_bf" value="<?php echo get_option('pn_logo_bf'); ?>" size="152" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Телефон</th>
        <td><textarea name="pn_phone" rows="3" cols="150"><?php echo get_option('pn_phone'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Социальные сети</th>
        <td><textarea name="pn_social" rows="3" cols="150"><?php echo get_option('pn_social'); ?></textarea></td>
        </tr>
		<tr valign="top">
        <th scope="row">Карта</th>
        <td><input type="text" name="pn_maps" value="<?php echo get_option('pn_maps'); ?>" size="152" /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>