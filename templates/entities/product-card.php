<?php
	// Извлекаем и валидируем параметры
	$post_id = isset($args['post_id']) ? $args['post_id'] : '';
	$is_vertical = isset($args['is_vertical']) ? to_bool($args['is_vertical']) : false;

	$product_title = get_the_title($post_id);
	$product_permalink = get_permalink($post_id);
	$post_thumbnail;

	$product_thumbnail_id = get_product_gallery($post_id, 0);
	$product_thumbnail = !empty($product_thumbnail_id) ? wp_get_attachment_image_url($product_thumbnail_id, 'medium') : null;
	$product_rent_price = get_product_rent_price($post_id);
	$product_purchase_price = get_product_purchase_price($post_id);
	$product_power_nominal = get_product_power_nominal($post_id);
	$product_fuel_nominal = get_product_fuel_nominal($post_id);
	$product_tank_volume = get_product_tank_volume($post_id);
?>

<div class="product-card<?php if($is_vertical) { echo ' is-vertical'; } ?>">
	<div class="product-card__description">
		<div class="product-card-description__heading">
			<h3 class="heading is-size-h3">
				<?php echo $product_title; ?>
			</h3>
				<span class="product-card-price span is-is-size-ml is-hilight"><?php if ($product_rent_price > 0) { echo 'от '.$product_rent_price.' ₽/сут.'; } ?></span>
		</div>
		<div class="product-card-description__characteristics">
			<?php if ($product_power_nominal) : ?>
				<div class="characteristic">
					<div class="characteristic__label">Мощность</div>
					<div class="characteristic__value">
						<span class="icon" data-type="arrow-up-right"></span>
						<?php echo $product_power_nominal.' кВт'; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($product_fuel_nominal) : ?>
					<div class="characteristic">
						<div class="characteristic__label">Расход топлива</div>
						<div class="characteristic__value">
							<span class="icon" data-type="water-drop"></span>
							<?php echo $product_fuel_nominal.' л/ч'; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($product_tank_volume) : ?>
				<div class="characteristic">
					<div class="characteristic__label">Объём бака</div>
					<div class="characteristic__value">
						<span class="icon" data-type="cylinder"></span>
						<?php echo $product_tank_volume.' л'; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="product-card-description__actions">
			<a
				href="#buy"
				class="product-card-description-actions__target button is-style-primary is-wide"
			>
				<span class="icon" data-type="truck"></span>Заказать
			</a>
			<a
				href="<?php echo $product_permalink; ?>"
				class="product-card-description-actions__more button is-style-bordered is-aspect-ratio-1b1"
			>
				<span class="icon" data-type="info"></span>
			</a>
			<div
				class="product-card-price button is-style-transparent is-hilight"
			>
				от 2645 ₽/сут.
			</div>
		</div>
	</div>
	<div class="product-card__cover">
		<?php if (!empty($product_thumbnail)) : ?>
			<img
				src="<?php echo $product_thumbnail; ?>"
				alt="<?php echo $product_title; ?>"
			/>
		<?php endif; ?>
	</div>
</div>