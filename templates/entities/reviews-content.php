<?php

// Основные аргументы запроса
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
	'post_type'      => 'review',
	'post_status'    => 'publish',
	'posts_per_page' => get_option('posts_per_page'),
	'paged'          => $paged,
);

$reviews_query = new WP_Query($args);
?>

<div class="content-wrapper reviews__grid">
	<?php if ($reviews_query->have_posts()) : ?>
		<?php while ($reviews_query->have_posts()) : $reviews_query->the_post(); ?>
			<?php get_template_part('templates/entities/review-card'); ?>
		<?php endwhile; ?>
		<?php get_template_part('templates/entities/pagination', null, [ 'query' => $reviews_query ]); ?>
	<?php else : ?>
		<span class="span">Отзывы не найдены</span>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>