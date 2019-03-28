<?php
/*
Theme Name: Tekstil
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема Tekstil
Version: 1.0
*/

get_header(); ?>

<div class="main">
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
