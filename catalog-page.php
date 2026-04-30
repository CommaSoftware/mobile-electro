<?php

/*
 Template name: Страница «Каталог»
 Template post type: page
 */

get_header();

// Получаем параметры фильтрации из URL
$min_power = isset($_GET['min_power']) ? intval($_GET['min_power']) : '';
$max_power = isset($_GET['max_power']) ? intval($_GET['max_power']) : '';
$sort_type = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'default';

// Основные аргументы запроса
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => get_option('posts_per_page'),
	'paged'          => $paged,
);

// 1. ФИЛЬТРАЦИЯ ПО МОЩНОСТИ
if ($min_power !== '' && $max_power !== '') {
	$args['meta_query'] = array(
		array(
			'key'     => '_product_power_nominal',
			'type'    => 'NUMERIC',
			'value'   => array($min_power, $max_power),
			'compare' => 'BETWEEN',
		)
	);
}

// 2. СОРТИРОВКА
switch ($sort_type) {
	case 'price_asc':
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = '_product_rent_price';
		$args['order']    = 'ASC';
		break;

	case 'price_desc':
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = '_product_rent_price';
		$args['order']    = 'DESC';
		break;
	default:
		$args['orderby'] = 'date';
		$args['order']   = 'DESC';
		break;
}

// Выполняем запрос
$catalog_query = new WP_Query($args);

// Подсчет общего количества товаров (без фильтрации)
$total_all_args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
);
$total_all_query = new WP_Query($total_all_args);
$total_all_count = $total_all_query->found_posts;
wp_reset_postdata();

$current_count = $catalog_query->found_posts;

// Значения для слайдера (из URL или по умолчанию)
$slider_min = $min_power !== '' ? $min_power : 20;
$slider_max = $max_power !== '' ? $max_power : 500;

// Формируем строку с параметрами для пагинации
$query_params = array();
if ($min_power !== '') $query_params['min_power'] = $min_power;
if ($max_power !== '') $query_params['max_power'] = $max_power;
if ($sort_type !== 'default') $query_params['sort'] = $sort_type;

$query_string = !empty($query_params) ? '?' . http_build_query($query_params) : '';
?>

<section id="catalog" class="catalog">
	<div class="content-wrapper">
		<?php get_template_part('templates/entities/breadcrumbs', null, [['name' => 'Блог']]); ?>
	</div>
	<div class="content-wrapper catalog__content-grid">
		<div class="catalog__sidebar">
			<div class="catalog-sidebar__block">
				<div class="catalog-sidebar-block__header">
					<span class="heading is-size-h5 is-hilight">Мощность</span>
				</div>
				<div class="range" data-min-range="100">
					<div class="range-line">
						<div class="range-slider">
							<span class="range-selected"></span>
						</div>
						<div class="range-input">
							<input
								type="range"
								class="min"
								min="20"
								max="500"
								value="<?php echo esc_attr($slider_min); ?>"
								step="10"
							/>
							<input
								type="range"
								class="max"
								min="20"
								max="500"
								value="<?php echo esc_attr($slider_max); ?>"
								step="10"
							/>
						</div>
					</div>
					<div class="range-price">
						<label>
							мин.
							<input
								class="input is-size-xss"
								type="number"
								name="min"
								min="20"
								max="500"
								step="10"
								value="<?php echo esc_attr($slider_min); ?>"
							/>
						</label>
						<label>
							макс.
							<input
								class="input is-size-xss"
								type="number"
								name="max"
								min="20"
								max="500"
								step="10"
								value="<?php echo esc_attr($slider_max); ?>"
							/>
						</label>
					</div>
				</div>
			</div>
			<div class="catalog-sidebar__actions">
				<div class="button is-size-m is-style-bordered is-aspect-ratio-1b1" id="reset-filters">
					<span class="icon" data-type="filter-off"></span>
				</div>
				<div class="button is-size-m is-style-primary is-wide-full" id="apply-filters">
					Применить<span class="icon" data-type="filter"></span>
				</div>
			</div>
		</div>
		<div class="catalog__content">
			<div class="catalog-content__header">
				<span class="span is-size-m is-hilight">
					Найдено <?php echo $current_count; ?> результатов
				</span>
				<select class="select" name="sort" id="sort-select">
					<option value="default" <?php selected($sort_type, 'default'); ?>>По умолчанию</option>
					<option value="price_asc" <?php selected($sort_type, 'price_asc'); ?>>Сначала дешёвые</option>
					<option value="price_desc" <?php selected($sort_type, 'price_desc'); ?>>Сначала дорогие</option>
				</select>
			</div>
			
			<?php if ($catalog_query->have_posts()) : ?>
				<?php while ($catalog_query->have_posts()) : $catalog_query->the_post(); ?>
					<?php get_template_part("templates/entities/product-card"); ?>
				<?php endwhile; ?>
				
				<?php 
				// Модифицированная пагинация с сохранением параметров
				$big = 999999999;
				$paginate_links = paginate_links(array(
					'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'    => '?paged=%#%',
					'current'   => max(1, $paged),
					'total'     => $catalog_query->max_num_pages,
					'type'      => 'array',
					'prev_text' => '«',
					'next_text' => '»',
				));
				
				if (!empty($paginate_links)) {
					echo '<div class="pagination">';
					foreach ($paginate_links as $link) {
						// Добавляем параметры фильтрации к каждой ссылке
						if (strpos($link, 'href=') !== false) {
							if (!empty($query_string)) {
								$link = preg_replace('/(href=["\'])([^"\']*)(["\'])/', '$1$2' . $query_string . '$3', $link);
							}
						}
						echo $link;
					}
					echo '</div>';
				}
				?>
			<?php else : ?>
				<p>Товаров не найдено</p>
			<?php endif; ?>
			
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php get_template_part("templates/widgets/target-banner"); ?>
<?php get_template_part("templates/widgets/blog-view"); ?>

<?php get_footer(); ?>