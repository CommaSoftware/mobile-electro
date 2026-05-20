<?php
	$theme_reviews_show_in_front = get_theme_mod('reviews__show_in_front', Theme_Defaults::REVIEWS_SHOW_IN_FRONT);
	$theme_reviews_link = get_theme_mod('reviews__link', Theme_Defaults::REVIEWS_LINK);
	$theme_reviews_heading = get_theme_mod('reviews__heading', Theme_Defaults::REVIEWS_HEADING);
	$theme_reviews_description = get_theme_mod('reviews__description', Theme_Defaults::REVIEWS_DESCRIPTION);
	$theme_reviews_link_form = get_theme_mod('reviews__link_form', Theme_Defaults::REVIEWS_LINK_FORM);

	$args = array(
		'post_type'      => 'review',
		'post_status'    => 'publish',
		'posts_per_page' => 4,
	);

	$reviews_query = new WP_Query($args);
?>



<?php if($theme_reviews_show_in_front) : ?>
	<section id="reviews" class="reviews">
		<?php if (!empty($theme_reviews_heading) || !empty($theme_reviews_description)) : ?>
			<div class="content-wrapper">
				<div class="heading-block">
					<?php if (!empty($theme_reviews_heading)) : ?>
						<h2 class="heading is-size-h2"><?php echo $theme_reviews_heading; ?></h2>
					<?php endif; ?>
					<?php if (!empty($theme_reviews_description)) : ?>
						<span class="span is-size-m"><?php echo $theme_reviews_description ?></span>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div
			class="reviews-block content-wrapper is-grid-4 is-scrolled-adaptation"
		>
			<?php if ($reviews_query->have_posts()) : ?>
				<?php while ($reviews_query->have_posts()) : $reviews_query->the_post(); ?>
					<?php get_template_part('templates/entities/review-card'); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<span class="span">Отзывы не найдены</span>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<div class="content-wrapper">
			<div class="buttons-block">
				<?php if (!empty($theme_reviews_link)) : ?>
					<a href="<?php echo $theme_reviews_link_form; ?>" class="button is-style-primary"
						><span class="icon" data-type="star"></span>Оставить отзыв</a
					>
				<?php endif; ?>
				<?php if (!empty($theme_reviews_link)) : ?>
					<a href="<?php echo $theme_reviews_link; ?>" class="button is-style-bordered"
						>Смотреть всё</a
					>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>