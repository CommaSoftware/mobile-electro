<?php
	// Извлекаем и валидируем параметры
	$post_id = isset($args['post_id']) ? $args['post_id'] : '';
	$show_excerpt = isset($args['show_excerpt']) ? to_bool($args['show_excerpt']) : false;

	$post_title = get_the_title($post_id);
	$post_excerpt = has_excerpt($post_id) ? get_the_excerpt($post_id) : '';
	$post_permalink = get_permalink($post_id);
	$post_thumbnail = get_the_post_thumbnail($post_id, 'medium', array(
		'class' => 'blog-card-cover__image',
		'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: get_the_title(),
		'loading' => 'lazy'
	));
?>

<div class="blog-card">
	<div class="blog-card__cover">
		<?php if (!empty($post_thumbnail)) : ?>
			<?php echo $post_thumbnail; ?>
		<?php endif; ?>
	</div>
	<div class="blog-card__content">
		<h4 class="heading is-size-h4"><?php echo $post_title; ?></h4>
		<?php if ($show_excerpt) : ?>
			<span class="span"><?php echo $post_excerpt; ?></span>
		<?php endif; ?>
	</div>
	<div class="blog-card__footer">
		<a href="<?php echo $post_permalink; ?>" class="blog-card-footer__button"
			>Подробнее</a
		>
		<span
			class="icon is-color-hilight blog-card-footer__icon"
			data-type="arrow-up-right"
		></span>
	</div>
</div>