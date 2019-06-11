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
</div>

<?php get_footer(); ?>