<?php

/*
 Template name: Страница Генератора
 Template post type: product
 */

get_header();
?>

<?php if( have_posts() ) : the_post(); ?>

	<?php
		$theme_catalog_link = get_theme_mod('catalog__link', Theme_Defaults::CATALOG_LINK);
		$theme_product_buy_link = get_theme_mod('product__buy_link', Theme_Defaults::PRODUCT_BUY_LINK);
		$theme_product_delivery_name = get_theme_mod('product__delivery_name', Theme_Defaults::PRODUCT_DELIVERY_NAME);
		$theme_product_delivery_link = get_theme_mod('product__delivery_link', Theme_Defaults::PRODUCT_DELIVERY_LINK);
		$theme_product_product_rate_list = get_theme_mod('product__rate_list', Theme_Defaults::PRODUCT_RATE_LIST);
		$theme_product_rent_instruction = get_theme_mod('product__rent_instruction', Theme_Defaults::PRODUCT_RENT_INSTRUCTION);

		$product_title = get_the_title();
		$product_description = get_the_content();
		$product_gallery = get_product_gallery();

		$product_in_stock = is_product_in_stock();
		$product_rent_price = get_product_rent_price();
		$product_purchase_price = get_product_purchase_price();

		$product_power_nominal = get_product_power_nominal();
		$product_power_base = get_product_power_base();
		$product_power_max = get_product_power_max();

		$product_fuel_nominal = get_product_fuel_nominal();
		$product_fuel_base = get_product_fuel_base();
		$product_fuel_max = get_product_fuel_max();
		
		$product_tank_volume = get_product_tank_volume();
		$product_noise = get_product_noise();
		$product_execution = get_product_execution();

		$product_length = get_product_length();
		$product_width = get_product_width();
		$product_height = get_product_height();
		$product_sizes = $product_length.'*'.$product_width.'*'.$product_height;
		$product_weight = get_product_weight();

		$args_industries = [
			'taxonomy' => 'industries',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false,
		];
		$product_industries = get_the_terms( get_the_ID(), 'industries', $args_industries);
		$all_industries = get_terms($args_industries);

		$product_links = get_product_links();
?>

	<section id="product" class="product">
		<div class="content-wrapper">
			
			<?php get_template_part('templates/entities/breadcrumbs', null, [
				['name' => 'Каталог', 'href' => $theme_catalog_link],
				['name' => $product_title]
			]); ?>
			<div class="product-content">
				<?php if (!empty($product_gallery)): ?>
					<div class="product-slider">
						<div class="product-slider__items-block">
							<?php foreach ($product_gallery as $key => $image_id): ?>
								<div
									class="product-slider-item<?php if ($key == 0) { echo ' is-active';} ?>"
									style="
										--product-slider-item-image: url(<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>);
									"
								>
									<img
										src="<?php echo wp_get_attachment_image_url($image_id, 'thumbnail'); ?>"
										alt="<?php echo $product_title." — ".$key; ?>"
										class="product-slider-item__img"
									/>
									
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($theme_product_product_rate_list)) : ?>
					<div class="view-block is-accent">
						<span class="view-block__heading span is-size-s">
							Условия аренды:
						</span>
						<div class="view-block__content cms-content">
							<?php echo $theme_product_product_rate_list; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="view-block" id="characteristics">
					<h3 class="view-block__heading heading is-size-h3">
						Характеристики
					</h3>
					<div class="view-block__content cms-content">
						<h5>Общие</h5>
						<?php if ($product_power_nominal || $product_power_base || $product_power_max || $product_fuel_nominal || $product_fuel_base || $product_fuel_max || $product_tank_volume || $product_noise) : ?>
							
							<div class="characteristics-block">
								<?php if ($product_power_nominal) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Мощность (баз.)</div>
										<div class="characteristic__value">
											<span class="icon" data-type="arrow-up-right"></span>
											<?php echo $product_power_nominal.' кВт'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_power_base) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Мощность <mark>(нагр. 70%)</mark></div>
										<div class="characteristic__value">
											<span class="icon is-color-accent" data-type="arrow-up-right"></span>
											<?php echo $product_power_base.' кВт'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_power_max) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Мощность <mark>(нагр. 100%)</mark></div>
										<div class="characteristic__value">
											<span class="icon is-color-accent" data-type="arrow-up-right"></span>
											<?php echo $product_power_max.' кВт'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_fuel_nominal) : ?>
										<div class="characteristic is-style-row">
											<div class="characteristic__label">Расход топлива (баз.)</div>
											<div class="characteristic__value">
												<span class="icon" data-type="water-drop"></span>
												<?php echo $product_fuel_nominal.' л/ч'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_fuel_base) : ?>
										<div class="characteristic is-style-row">
											<div class="characteristic__label">Расход топлива <mark>(нагр. 70%)</mark></div>
											<div class="characteristic__value">
												<span class="icon is-color-accent" data-type="water-drop"></span>
												<?php echo $product_fuel_base.' л/ч'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_fuel_max) : ?>
										<div class="characteristic is-style-row">
											<div class="characteristic__label">Расход топлива <mark>(нагр. 100%)</mark></div>
											<div class="characteristic__value">
												<span class="icon is-color-accent" data-type="water-drop"></span>
												<?php echo $product_fuel_max.' л/ч'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_tank_volume) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Объём бака</div>
										<div class="characteristic__value">
											<span class="icon" data-type="cylinder"></span>
											<?php echo $product_tank_volume.' л'; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($product_noise) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Шум</div>
										<div class="characteristic__value">
											<span class="icon" data-type="volume"></span>
											<?php echo $product_noise.' дец'; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php else : ?>
							<span class="span is-size-xs">не указаны</span>
						<?php endif; ?>
						<h5>Габариты</h5>
						<?php if ( $product_length || $product_width || $product_height || $product_weight || $product_execution ) : ?>
							<div class="characteristics-block">
								<?php if($product_length || $product_width || $product_height) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Размер Д*Ш*В</div>
										<div class="characteristic__value">
											<span class="icon" data-type="ruler"></span>
											<?php echo $product_sizes.' мм' ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if($product_weight) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Вес</div>
										<div class="characteristic__value">
											<span class="icon" data-type="weight"></span>
											<?php echo $product_weight.' кг' ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if($product_execution) : ?>
									<div class="characteristic is-style-row">
										<div class="characteristic__label">Исполнение</div>
										<div class="characteristic__value">
											<?php echo $product_execution; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php else : ?>
							<span class="span is-size-xs">не указаны</span>
						<?php endif; ?>
					</div>
				</div>
				<?php if(!empty($product_description)) : ?>
					<div class="view-block">
						<h3 class="view-block__heading heading is-size-h3">Описание</h3>
						<div class="view-block__content cms-content">
							<?php echo $product_description; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="view-block">
					<h3 class="view-block__heading heading is-size-h3">
						Подходит для объектов
					</h3>
					<div class="view-block__content cms-content">
						<ul class="checked-list">
							<?php if(!empty($product_industries)): ?>
								<?php foreach ($product_industries as $product_industry) : ?>
									<li><?php echo $product_industry->name; ?></li>
								<?php endforeach; ?>
							<?php else : ?>
								<?php foreach ($all_industries as $product_industry) : ?>
									<li><?php echo $product_industry->name; ?></li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php if(!empty($theme_product_rent_instruction)) : ?>
					<div class="view-block">
						<h3 class="view-block__heading heading is-size-h3">
							Как купить или взять в аренду
						</h3>
						<div class="view-block__content cms-content">
							<?php echo $theme_product_rent_instruction; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if (!empty($product_links)) : ?>
					<div class="view-block">
						<h3 class="view-block__heading heading is-size-h3">
							Файлы и инструкции
						</h3>
						<div class="view-block__content cms-content">
							<?php foreach ($product_links as $product_link) : ?>
								<a href="<?php echo $product_link['url'] ?>" target="_blank" class="button">
									<span class="icon" data-type="link-horizontal"></span>
									<?php 
										$product_link_text = $product_link['text'];
										if (!empty($product_link_text)) :
											echo $product_link_text;
										else :
											$product_link_filename = basename($product_link['url']);
											echo strlen($product_link_filename) > 50 ? substr($product_link_filename, 0, 47) . '...' : $product_link_filename;
										endif;
									?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="view-block is-accent">
					<h3 class="view-block__heading heading is-size-h3">
						Работая с нами вы получаете
					</h3>
					<div class="view-block__content cms-content">
						<div class="product-advantages">
							<div class="product-advantages__item">
								<span
									class="icon is-color-accent"
									data-type="wavy-check"
								></span>
								<span class="span is-size-s"
									>Гарантию на все виды работ и запчастей</span
								>
							</div>
							<div class="product-advantages__item">
								<span
									class="icon is-color-accent"
									data-type="shopping-bag"
								></span>
								<span class="span is-size-s">Гибкие тарифы на услуги</span>
							</div>
							<div class="product-advantages__item">
								<span
									class="icon is-color-accent"
									data-type="waving-help"
								></span>
								<span class="span is-size-s">Бесплатную диагностику</span>
							</div>
							<div class="product-advantages__item">
								<span class="icon is-color-accent" data-type="truck"></span>
								<span class="span is-size-s"
									>Выездные сервисные бригады 24/7</span
								>
							</div>
							<div class="product-advantages__item">
								<span class="icon is-color-accent" data-type="timer"></span>
								<span class="span is-size-s"
									>Оперативную доставку генераторов</span
								>
							</div>
							<div class="product-advantages__item">
								<span class="icon is-color-accent" data-type="puzzle"></span>
								<span class="span is-size-s"
									>Персональные решения от наших инженеров</span
								>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="product-sidebar">
				<div class="product-sidebar__content">
					<h1 class="heading is-size-h1"><?php echo $product_title; ?></h1>
					<div class="characteristics-block">
						<?php if ($product_power_nominal) : ?>
							<div class="characteristic is-style-row">
								<div class="characteristic__label">Мощность</div>
								<div class="characteristic__value">
									<span class="icon" data-type="arrow-up-right"></span>
									<?php echo $product_power_nominal.' кВт'; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ($product_fuel_nominal) : ?>
								<div class="characteristic is-style-row">
									<div class="characteristic__label">Расход топлива</div>
									<div class="characteristic__value">
										<span class="icon" data-type="water-drop"></span>
										<?php echo $product_fuel_nominal.' л/ч'; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ($product_tank_volume) : ?>
							<div class="characteristic is-style-row">
								<div class="characteristic__label">Объём бака</div>
								<div class="characteristic__value">
									<span class="icon" data-type="cylinder"></span>
									<?php echo $product_tank_volume.' л'; ?>
								</div>
							</div>
						<?php endif; ?>
						<a
							href="#characteristics"
							class="button is-size-xs is-style-readmore"
							>Подробнее<span class="icon" data-type="chervon-right"></span
						></a>
					</div>
					<?php if ($product_rent_price || $product_purchase_price) : ?>
						<div class="product-price">
							<?php if ($product_rent_price) : ?>
								<div class="product-price__item">
									<span class="span is-hilight is-size-s">Арендовать</span>
									<span class="product-price-item__cost is-style-accent"
										><?php echo 'от '.$product_rent_price.' ₽/сут.'; ?></span
									>
								</div>
							<?php endif; ?>
							<?php if ($product_purchase_price) : ?>
								<div class="product-price__item">
									<span class="span is-hilight is-size-s">Купить</span>
									<span class="product-price-item__cost"><?php echo number_format($product_purchase_price, 0, '', ' ').' ₽'; ?></span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="product-sidebar-actions">
						<?php if ($theme_product_delivery_name) : ?>
							<div class="product-sidebar-actions__row">
								<a
									href="<?php echo $theme_product_delivery_link; ?>"
									class="button is-size-s is-style-transparent is-hilight"
								>
									<span class="icon" data-type="map-pin"></span>
									<?php echo $theme_product_delivery_name; ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="product-sidebar-actions__row">
							<?php if($product_in_stock) : ?>
								<div class="button is-size-l is-no-hover">
									<span
										class="icon is-color-accent"
										data-type="radio-fill"
									></span>
									В наличии
								</div>
								<a
									href="<?php echo $theme_product_buy_link;?>"
									class="button is-size-l is-style-accent is-wide-full"
								>
									<span class="icon" data-type="truck"></span>
									Заказать
								</a>
							<?php else: ?>
								<div class="button is-size-l is-no-hover">
									<span class="icon" data-type="radio"></span>
									Нет в наличии
								</div>
								<a href="<?php echo $theme_product_buy_link;?>" class="button is-size-l is-style-primary is-wide-full">
									Предзаказ
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>


<?php get_template_part("templates/widgets/catalog-view"); ?>
<?php get_template_part("templates/widgets/target-banner"); ?>

<?php get_footer(); ?>