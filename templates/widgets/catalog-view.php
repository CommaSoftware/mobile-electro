<?php
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 4,
		'orderby' => 'date',
		'order' => 'DESC',
		'ignore_sticky_posts' => 0, // 0 - учитывать закреплённые, 1 - игнорировать
	);
	$query = new WP_Query($args);

	$theme_product_view_show_on_front = get_theme_mod("product_view__show_on_front", Theme_Defaults::BLOG_VIEW_SHOW_ON_FRONT);
	$theme_product_view_heading = get_theme_mod("product_view__heading", Theme_Defaults::BLOG_VIEW_HEADING);
	$theme_product_view_description = get_theme_mod("product_view__description", Theme_Defaults::BLOG_VIEW_DESCRIPTION);
	$theme_catalog_link = get_theme_mod("catalog__link", Theme_Defaults::CATALOG_LINK);

?>

<?php if (is_front_page() && $theme_product_view_show_on_front) : ?>
	<section id="catalog_preview" class="catalog-preview">
		<div class="content-wrapper">
			<?php if ($theme_product_view_description != '' || $theme_product_view_heading != '') : ?>
				<div class="heading-block">
					<?php if ($theme_product_view_heading != '') : ?>
						<h2 class="heading is-size-h2"><?php echo $theme_product_view_heading; ?></h2>
					<?php endif; ?>
					<?php if ($theme_product_view_description != '') : ?>
						<span class="span is-size-m"><?php echo $theme_product_view_description; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ($query->have_posts()) : ?>
			<div class="content-wrapper is-grid-4 is-scrolled-adaptation catalog-preview__items-block">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<?php get_template_part('templates/entities/product-card', null, ['post_id' => get_the_ID(), 'is_vertical' => true]); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
		
				
		<div class="content-wrapper">
			<div class="buttons-block">
				<a href="<?php echo $theme_catalog_link; ?>" class="button is-style-bordered"
					><span class="icon" data-type="grid"></span>Каталог генераторов</a
				>
			</div>
		</div>
	</section>
<?php endif; ?>