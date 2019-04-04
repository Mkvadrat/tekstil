<?php
/*
Template name: Main page
Theme Name: Tekstil
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта Tekstil
Version: 1.0
*/

get_header();
?>

<div class="main">
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
	
	<?php if(get_option('pn_maps')){ ?>
	<div class="section-maps">
        <div class="container-fluid">
			<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
			
			<div id="map" style="width:100%; height:600px"></div>
			
			<script type="text/javascript">
				//start maps
				ymaps.ready(init);
	
				function init () {
					var myMap = new ymaps.Map("map", {
						center: [<?php echo get_option('pn_maps'); ?>],
						zoom: 18,
						<!--Скрыть элементы управления: controls: []	 -->
						controls: []
					}, {
					searchControlProvider: 'yandex#search'
					});
	
					if (window.matchMedia("(max-width: 1500px)").matches) {
						myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
					};
					if (window.matchMedia("(max-width: 992px)").matches) {
						myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
					};
					if (window.matchMedia("(max-width: 767px)").matches) {
						myMap.setCenter([<?php echo get_option('pn_maps'); ?>])
					};
	
					myGeoObject = new ymaps.GeoObject({
	
					properties: {
	
						iconContent: 'Lorem',
						hintContent: 'Компания "Lorem"'
					}
					}, {
	
						preset: 'islands#blackStretchyIcon',
	
						draggable: false,
	
					});
	
					myMap.behaviors
	
					.disable('scrollZoom')
	
					myMap.geoObjects
					.add(myGeoObject)
					.add(new ymaps.Placemark([<?php echo get_option('pn_maps'); ?>], {
						iconCaption: 'ул. Леси Украинки.д4'
					}, {
						preset: 'islands#greenDotIconWithCaption'
					}))
	
				}
			</script>
		</div>
    </div>
	<?php } ?>
</div>
    
<?php get_footer(); ?>