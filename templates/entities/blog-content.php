<?php 
	$theme_blog_answer_to_empty = get_theme_mod("blog__answer_to_empty", Theme_Defaults::BLOG_ANSWER_TO_EMPTY);

	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	elseif ( get_query_var('page') ) $paged = get_query_var('page');
	else $paged = 1;

	$args = array(
		'post_type' => 'post',
		'paged' => $paged,
	);

	if (is_category()) {
		$args['cat'] = get_queried_object_id();
	}

	$regular_query = new WP_Query($args);
?>

<section id="blog" class="blog">
	<div class="content-wrapper blog__grid">
		<?php get_template_part('templates/entities/blog-sidebar') ?>
		<?php if ($regular_query->have_posts()) : ?>
			<?php	while ($regular_query->have_posts()) : ?>
				<?php	$regular_query->the_post(); ?>
				<?php get_template_part('templates/entities/blog-card', null, ['post_id' => get_the_ID(), 'show_excerpt' => true]); ?>
			<?php endwhile; ?> 
			<?php get_template_part('templates/entities/pagination', null, [ 'query' => $regular_query ]); ?>
		<?php else : ?>
			<span class="span is-size-m"><?php echo $theme_blog_answer_to_empty; ?></span>
		<?php endif; ?>
		<?php wp_reset_postdata(); wp_reset_query(); ?>
	</div>
</section>