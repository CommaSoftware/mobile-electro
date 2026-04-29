<?php
/**
 * Custom fields for "product"
 * Исправленная и безопасная версия
 */

// Регистрация всех мета-полей
add_action('init', 'register_product_meta_fields');
function register_product_meta_fields() {
	register_meta('post', '_product_gallery', array(
		'type' => 'array',
		'description' => 'Product gallery',
		'single' => true,
		'show_in_rest' => array(
			'schema' => array(
				'type' => 'array',
				'items' => array(
					'type' => 'integer'
				)
			)
		),
		'auth_callback' => function() {
			return current_user_can('edit_posts');
		}
	));

	$numeric_fields = array(
		'_product_rent_price',
		'_product_purchase_price',
		'_product_power_nominal',
		'_product_power_base',
		'_product_power_max',
		'_product_fuel_nominal',
		'_product_fuel_base',
		'_product_fuel_max',
		'_product_tank_volume',
		'_product_noise',
		'_product_length',
		'_product_width',
		'_product_height',
		'_product_weight'
	);
	
	foreach ($numeric_fields as $field) {
		register_meta('post', $field, array(
			'type' => 'number',
			'description' => 'Product field',
			'single' => true,
			'show_in_rest' => true,
			'auth_callback' => function() {
				return current_user_can('edit_posts');
			}
		));
	}
	
	register_meta('post', '_product_execution', array(
		'type' => 'string',
		'description' => 'Product execution',
		'single' => true,
		'show_in_rest' => true,
		'auth_callback' => function() {
			return current_user_can('edit_posts');
		}
	));
	
	register_meta('post', '_product_in_stock', array(
		'type' => 'boolean',
		'description' => 'Product in stock',
		'single' => true,
		'show_in_rest' => true,
		'auth_callback' => function() {
			return current_user_can('edit_posts');
		}
	));

	register_meta('post', '_product_links', array(
		'type' => 'array',
		'description' => 'Product external links with text',
		'single' => true,
		'show_in_rest' => array(
			'schema' => array(
				'type' => 'array',
				'items' => array(
					'type' => 'object',
					'properties' => array(
						'url' => array(
							'type' => 'string',
							'format' => 'uri',
						),
						'text' => array(
							'type' => 'string',
						),
					),
				),
			),
		),
		'auth_callback' => function() {
			return current_user_can('edit_posts');
		}
	));
}

// Добавление мета-боксов
add_action('add_meta_boxes', 'add_product_meta_boxes');
function add_product_meta_boxes() {
	add_meta_box(
		'product_gallery_meta_box',
		'Галерея изображений',
		'render_product_gallery_meta_box',
		'product',
		'normal',
		'high'
	);

	add_meta_box(
		'product_details_meta_box',
		'Характеристики генератора',
		'render_product_meta_box',
		'product',
		'normal',
		'high'
	);

	add_meta_box(
		'product_files_meta_box',
		'Файлы товара (PDF, DOC, и т.д.)',
		'render_product_files_meta_box',
		'product',
		'normal',
		'high'
	);
}

// Отображение основных мета-полей
function render_product_meta_box($post) {
	wp_nonce_field('product_meta_box_action', 'product_meta_box_nonce');
	
	$rent_price = get_post_meta($post->ID, '_product_rent_price', true);
	$purchase_price = get_post_meta($post->ID, '_product_purchase_price', true);
	$in_stock = get_post_meta($post->ID, '_product_in_stock', true);
	
	$power_nominal = get_post_meta($post->ID, '_product_power_nominal', true);
	$power_base = get_post_meta($post->ID, '_product_power_base', true);
	$power_max = get_post_meta($post->ID, '_product_power_max', true);
	$fuel_nominal = get_post_meta($post->ID, '_product_fuel_nominal', true);
	$fuel_base = get_post_meta($post->ID, '_product_fuel_base', true);
	$fuel_max = get_post_meta($post->ID, '_product_fuel_max', true);
	$tank_volume = get_post_meta($post->ID, '_product_tank_volume', true);
	$noise = get_post_meta($post->ID, '_product_noise', true);
	if (empty($noise) && $noise !== '0') $noise = 97;
	
	$execution = get_post_meta($post->ID, '_product_execution', true);
	if (empty($execution)) $execution = 'в кожухе';
	
	$length = get_post_meta($post->ID, '_product_length', true);
	$width = get_post_meta($post->ID, '_product_width', true);
	$height = get_post_meta($post->ID, '_product_height', true);
	$weight = get_post_meta($post->ID, '_product_weight', true);
	?>
	
	<style>
		.product-meta-fields {
			display: flex;
			flex-direction: column;
			gap: 12px;
			padding: 6px 0;
		}
		.product-meta-fields .field-group {
			padding: 12px;
			background: white;
			border: 1px solid #e5e5e5;
			border-radius: 4px;
		}
		.product-meta-fields .field-row .description {
			margin-left: 10px;
			color: #666;
			font-size: 12px;
		}
		.product-meta-fields h3 {
			margin-top: 0;
			margin-bottom: 0;
			color: #0073aa;
		}
		.field-group__items {
			display: flex;
			gap: 12px;
			flex-wrap: wrap;
			margin-top: 12px;
		}
		.field-group__items .field-row {
			flex: 1;
			min-width: 120px;
		}
		.field-group__items .field-row input:not([type="checkbox"]) {
			width: 100%;
			max-width: none;
		}
		
		.field-group__items .field-row label {
			display: inline-block;
			padding-bottom: 4px;
		}
	</style>
	
	<div class="product-meta-fields">
			<!-- Блок цен и наличия -->
			<div class="field-group">
				<h3>Цены и наличие</h3>
				<div class="field-group__items">
					<div class="field-row">
						<label for="product_rent_price">Стоимость аренды (₽/день):</label>
						<input 
							type="number" 
							id="product_rent_price" 
							name="_product_rent_price" 
							value="<?php echo esc_attr($rent_price); ?>" 
							step="1" 
							min="0" />
						<span class="description">Укажите 0, если не доступен для аренды</span>
					</div>
					<div class="field-row">
						<label for="product_purchase_price">Стоимость покупки (₽):</label>
						<input type="number" 
							id="product_purchase_price" 
							name="_product_purchase_price" 
							value="<?php echo esc_attr($purchase_price); ?>" 
							step="1" 
							min="0" />
						<span class="description">Укажите 0, если не доступен для покупки</span>
					</div>
				</div>
				<div class="field-group__items">
					<div class="field-row">
						<input 
							type="checkbox" 
							id="product_in_stock" 
							name="_product_in_stock" 
							value="1" 
							<?php checked($in_stock, '1'); ?> />
						<label for="product_in_stock">Есть в наличии</label>
					</div>
				</div>
			</div>
			
			<!-- Блок мощностей -->
			<div class="field-group">
					<h3>Мощность (кВт)</h3>
					<div class="field-group__items">
						<div class="field-row">
							<label for="product_power_nominal">Мощность номинальная:</label>
							<input 
								type="number" 
								id="product_power_nominal" 
								name="_product_power_nominal" 
								value="<?php echo esc_attr($power_nominal); ?>" 
								step="1" 
								min="0" />
						</div>
						<div class="field-row">
							<label for="product_power_base">Мощность базовая (нагр. 70%):</label>
							<input 
								type="number" 
								id="product_power_base" 
								name="_product_power_base" 
								value="<?php echo esc_attr($power_base); ?>" 
								step="1" 
								min="0" />
						</div>
						<div class="field-row">
							<label for="product_power_max">Мощность максимальная (нагр. 100%):</label>
							<input 
								type="number" 
								id="product_power_max" 
								name="_product_power_max" 
								value="<?php echo esc_attr($power_max); ?>" 
								step="1" 
								min="0" />
						</div>
				</div>
			</div>
			
			<!-- Блок расхода топлива -->
			<div class="field-group">
				<h3>Расход топлива (л/ч)</h3>
				<div class="field-group__items">
					<div class="field-row">
						<label for="product_fuel_nominal">Расход топлива номинальный:</label>
						<input 
							type="number" 
							id="product_fuel_nominal" 
							name="_product_fuel_nominal" 
							value="<?php echo esc_attr($fuel_nominal); ?>" 
							step="0.1" 
							min="0" />
					</div>
					<div class="field-row">
						<label for="product_fuel_base">Расход топлива базовый (нагр. 70%):</label>
						<input 
							type="number" 
							id="product_fuel_base" 
							name="_product_fuel_base" 
							value="<?php echo esc_attr($fuel_base); ?>" 
							step="0.1" 
							min="0" />
					</div>
					<div class="field-row">
						<label for="product_fuel_max">Расход топлива максимальный (нагр. 100%):</label>
						<input 
							type="number" 
							id="product_fuel_max" 
							name="_product_fuel_max" 
							value="<?php echo esc_attr($fuel_max); ?>" 
							step="0.1"
							min="0" />
					</div>
				</div>
			</div>
			
			<!-- Блок технических характеристик -->
			<div class="field-group">
				<h3>Другие характеристики</h3>
				<div class="field-group__items">
					<div class="field-row">
						<label for="product_tank_volume">Объём бака (л):</label>
						<input type="number" 
							id="product_tank_volume" 
							name="_product_tank_volume" 
							value="<?php echo esc_attr($tank_volume); ?>" 
							step="1" 
							min="0" />
					</div>
					<div class="field-row">
						<label for="product_noise">Шум (дБ):</label>
						<input type="number" 
							id="product_noise" 
							name="_product_noise" 
							value="<?php echo esc_attr($noise); ?>" 
							step="1" 
							min="0" />
						<span class="description">По умолчанию: 97 дБ</span>
					</div>
					<div class="field-row">
						<label for="product_execution">Исполнение:</label>
						<input type="text" 
							id="product_execution" 
							name="_product_execution" 
							value="<?php echo esc_attr($execution); ?>" />
						<span class="description">По умолчанию: "в кожухе"</span>
					</div>
				</div>
			</div>
			
			<!-- Блок размеров и веса -->
			<div class="field-group">
					<h3>Габариты и вес</h3>
					<div class="field-group__items">
						<div class="field-row">
							<label for="product_length">Длина (мм):</label>
							<input 
								type="number" 
								id="product_length" 
								name="_product_length" 
								value="<?php echo esc_attr($length); ?>" 
								step="1" 
								min="0" />
						</div>
							
						<div class="field-row">
							<label for="product_width">Ширина (мм):</label>
							<input 
								type="number" 
								id="product_width" 
								name="_product_width" 
								value="<?php echo esc_attr($width); ?>" 
								step="1" 
								min="0" />
						</div>
						<div class="field-row">
							<label for="product_height">Высота (мм):</label>
							<input type="number" 
								id="product_height" 
								name="_product_height" 
								value="<?php echo esc_attr($height); ?>" 
								step="1" 
								min="0" />
						</div>
						<div class="field-row">
							<label for="product_weight">Вес (кг):</label>
							<input 
								type="number" 
								id="product_weight" 
								name="_product_weight" 
								value="<?php echo esc_attr($weight); ?>" 
								step="1" 
								min="0" />
						</div>
					</div>
			</div>
	</div>
	
	<?php
}

// Отображение галереи изображений (исправленная версия)
function render_product_gallery_meta_box($post) {
	wp_nonce_field('product_gallery_meta_box_action', 'product_gallery_meta_box_nonce');
	
	$gallery_images = get_post_meta($post->ID, '_product_gallery', true);
	if (!is_array($gallery_images)) {
		$gallery_images = array();
	}
	?>
	
	<style>
		.product-gallery-container {
			padding: 15px;
		}
		.gallery-images-list {
			display: flex;
			flex-wrap: wrap;
			gap: 15px;
			margin-bottom: 20px;
		}
		.gallery-image-item {
			position: relative;
			width: 120px;
			height: 120px;
			border: 2px solid #ddd;
			border-radius: 4px;
			overflow: hidden;
			background: #f5f5f5;
			cursor: move;
		}
		.gallery-image-item img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		.gallery-image-item .remove-image {
			position: absolute;
			top: 5px;
			right: 5px;
			background: rgba(0,0,0,0.7);
			color: white;
			border: none;
			border-radius: 50%;
			width: 25px;
			height: 25px;
			cursor: pointer;
			font-size: 16px;
			line-height: 1;
			padding: 0;
			z-index: 2;
		}
		.gallery-image-item .remove-image:hover {
				background: #d32f2f;
		}
		.image-order {
			position: absolute;
			bottom: 5px;
			left: 5px;
			background: rgba(0,0,0,0.7);
			color: white;
			padding: 2px 6px;
			border-radius: 3px;
			font-size: 12px;
			z-index: 2;
		}
	</style>
	
	<div class="product-gallery-container">
		<div class="gallery-images-list" id="gallery_images_list">
			<?php foreach ($gallery_images as $index => $image_id): 
				$image_id = absint($image_id);
				$image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
				if ($image_url):
			?>
				<div class="gallery-image-item" data-image-id="<?php echo esc_attr($image_id); ?>">
					<img src="<?php echo esc_url($image_url); ?>" alt="">
					<button type="button" class="remove-image" data-image-id="<?php echo esc_attr($image_id); ?>">×</button>
					<div class="image-order"><?php echo absint($index + 1); ?></div>
				</div>
			<?php 
					endif;
			endforeach; ?>
		</div>
		
		<button type="button" class="button button-add-image" id="add_gallery_image">+ Добавить изображение</button>
		<p class="description">Максимум 10 изображений. Нажмите на изображение для сортировки (перетащите).</p>
		
		<input type="hidden" id="gallery_images_data" name="_product_gallery" value="<?php echo esc_attr(implode(',', array_map('absint', $gallery_images))); ?>" />
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		var maxImages = 10;
		
		function updateGalleryOrder() {
			$('#gallery_images_list .gallery-image-item').each(function(index) {
				$(this).find('.image-order').text(index + 1);
			});
			
			var imageIds = [];
			$('#gallery_images_list .gallery-image-item').each(function() {
				imageIds.push($(this).data('image-id'));
			});
			$('#gallery_images_data').val(imageIds.join(','));
		}
		
		$('#add_gallery_image').on('click', function(e) {
			e.preventDefault();
			
			var currentCount = $('#gallery_images_list .gallery-image-item').length;
			if (currentCount >= maxImages) {
				alert('Максимум ' + maxImages + ' изображений');
				return;
			}
			
			var frame = wp.media({
				title: 'Выберите изображение для галереи',
				multiple: false,
				library: { type: 'image' },
				button: { text: 'Выбрать' }
			});
			
			frame.on('select', function() {
				var attachment = frame.state().get('selection').first().toJSON();
				var imageId = attachment.id;
				var imageUrl = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
				
				var newItem = $('<div class="gallery-image-item" data-image-id="' + escapeHtml(String(imageId)) + '">' +
					'<img src="' + escapeHtml(imageUrl) + '" alt="">' +
					'<button type="button" class="remove-image" data-image-id="' + escapeHtml(String(imageId)) + '">×</button>' +
					'<div class="image-order">' + ($('#gallery_images_list .gallery-image-item').length + 1) + '</div>' +
					'</div>');
				
				$('#gallery_images_list').append(newItem);
				updateGalleryOrder();
			});
			
			frame.open();
		});
		
		$(document).on('click', '.remove-image', function(e) {
			e.stopPropagation();
			$(this).closest('.gallery-image-item').remove();
			updateGalleryOrder();
		});
		
		$('#gallery_images_list').sortable({
			update: function() {
				updateGalleryOrder();
			}
		});
		
		// Улучшенная функция экранирования для JavaScript
		function escapeHtml(text) {
			if (!text) return '';
			var div = document.createElement('div');
			div.appendChild(document.createTextNode(text));
			return div.innerHTML;
		}
	});
	</script>
	
	<?php
}

// Отображение Файлов (исправленная версия)
function render_product_files_meta_box($post) {
	wp_nonce_field('product_files_meta_box_action', 'product_files_meta_box_nonce');
	
	$links = get_post_meta($post->ID, '_product_links', true);
	if (!is_array($links)) {
		$links = array();
	}
	?>
	
	<style>
		.product-links-container {
			padding: 6px 0;
		}
		.links-list {
			margin-bottom: 20px;
		}
		.link-item {
			margin-bottom: 15px;
			padding: 10px;
			background: #f9f9f9;
			border: 1px solid #e5e5e5;
			border-radius: 4px;
		}
		.link-item .link-fields {
			display: flex;
			gap: 10px;
			align-items: flex-start;
			margin-bottom: 8px;
		}
		.link-item .link-field {
			flex: 1;
		}
		.link-item .link-field label {
			display: block;
			margin-bottom: 4px;
			font-size: 12px;
			color: #666;
		}
		.link-item .link-field input {
			width: 100%;
		}
		.link-item .remove-link {
			margin-top: 24px;
			border: none;
			background: none;
			text-decoration: underline;
			color: #d32f2f;
			cursor: pointer;
			padding: 0;
		}
		.add-link-row {
			display: flex;
			gap: 10px;
			align-items: flex-end;
			margin-top: 15px;
			padding: 10px;
			background: #f0f0f0;
			border-radius: 4px;
		}
		.add-link-row .add-field {
			flex: 1;
		}
		.add-link-row .add-field label {
			display: block;
			margin-bottom: 4px;
			font-size: 12px;
			color: #666;
		}
		.add-link-row input {
			width: 100%;
		}
		.link-order {
			font-size: 11px;
			color: #999;
			margin-top: 5px;
		}
	</style>
	
	<div class="product-links-container">
		<div class="links-list" id="links_list">
			<?php foreach ($links as $index => $link): 
				$url = isset($link['url']) ? esc_url_raw($link['url']) : '';
				$text = isset($link['text']) ? sanitize_text_field($link['text']) : '';
				if (empty($url)) continue;
			?>
				<div class="link-item" data-index="<?php echo esc_attr($index); ?>">
					<div class="link-fields">
						<div class="link-field">
							<label>URL ссылки *</label>
							<input 
								type="url" 
								name="_product_links[<?php echo esc_attr($index); ?>][url]" 
								value="<?php echo esc_url($url); ?>" 
								placeholder="https://example.com/file.pdf" />
						</div>
						<div class="link-field">
							<label>Текст ссылки (необязательно)</label>
							<input 
								type="text" 
								name="_product_links[<?php echo esc_attr($index); ?>][text]" 
								value="<?php echo esc_attr($text); ?>" 
								placeholder="Например: Скачать инструкцию" />
						</div>
						<button type="button" class="remove-link">Удалить</button>
					</div>
					<div class="link-order">№<?php echo absint($index + 1); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<div class="add-link-row">
			<div class="add-field">
				<label>URL новой ссылки *</label>
				<input type="url" id="new_link_url" placeholder="https://example.com/file.pdf" />
			</div>
			<div class="add-field">
				<label>Текст новой ссылки</label>
				<input type="text" id="new_link_text" placeholder="Текст ссылки (необязательно)" />
			</div>
			<button type="button" class="button" id="add_link_btn">+ Добавить ссылку</button>
		</div>
		<p class="description">Добавляйте ссылки на файлы (инструкции, сертификаты, схемы и т.д.)</p>
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		var linkCounter = $('#links_list .link-item').length;
		
		function isValidUrl(string) {
			try {
				const url = new URL(string);
				return url.protocol === 'http:' || url.protocol === 'https:';
			} catch (_) {
				return false;
			}
		}
		
		function updateLinkNumbers() {
			$('#links_list .link-item').each(function(index) {
				$(this).find('.link-order').text('№' + (index + 1));
				$(this).find('input[name^="_product_links"]').each(function() {
					var name = $(this).attr('name');
					name = name.replace(/\[(\d+)\]/, '[' + index + ']');
					$(this).attr('name', name);
				});
			});
			linkCounter = $('#links_list .link-item').length;
		}
		
		$('#add_link_btn').on('click', function(e) {
			e.preventDefault();
			
			var newUrl = $('#new_link_url').val().trim();
			var newText = $('#new_link_text').val().trim();
			
			if (!newUrl) {
				alert('Пожалуйста, введите URL ссылки');
				return;
			}
			
			if (!newUrl.match(/^https?:\/\//i)) {
				newUrl = 'https://' + newUrl;
			}
			
			if (!isValidUrl(newUrl)) {
				alert('Пожалуйста, введите корректный URL (начинающийся с http:// или https://)');
				return;
			}
			
			if (newUrl.toLowerCase().indexOf('javascript:') === 0 || 
				newUrl.toLowerCase().indexOf('data:') === 0 || 
				newUrl.toLowerCase().indexOf('vbscript:') === 0) {
				alert('Недопустимый тип URL');
				return;
			}
			
			var newIndex = linkCounter;
			var newItem = $('<div class="link-item">' +
				'<div class="link-fields">' +
				'<div class="link-field">' +
				'<label>URL ссылки *</label>' +
				'<input type="url" name="_product_links[' + newIndex + '][url]" value="' + escapeHtml(newUrl) + '" placeholder="https://example.com/file.pdf" />' +
				'</div>' +
				'<div class="link-field">' +
				'<label>Текст ссылки (необязательно)</label>' +
				'<input type="text" name="_product_links[' + newIndex + '][text]" value="' + escapeHtml(newText) + '" placeholder="Например: Скачать инструкцию" />' +
				'</div>' +
				'<button type="button" class="remove-link">Удалить</button>' +
				'</div>' +
				'<div class="link-order">№' + (newIndex + 1) + '</div>' +
				'</div>');
			
			$('#links_list').append(newItem);
			$('#new_link_url').val('');
			$('#new_link_text').val('');
			updateLinkNumbers();
		});
		
		$('#new_link_url, #new_link_text').on('keypress', function(e) {
			if (e.which === 13) {
				e.preventDefault();
				$('#add_link_btn').click();
			}
		});
		
		$(document).on('click', '.remove-link', function() {
			$(this).closest('.link-item').remove();
			updateLinkNumbers();
		});
		
		function escapeHtml(text) {
			if (!text) return '';
			var div = document.createElement('div');
			div.appendChild(document.createTextNode(text));
			return div.innerHTML;
		}
	});
	</script>
	
	<?php
}

// Сохранение всех мета-полей (исправленная версия)
add_action('save_post_product', 'save_product_meta_fields', 10, 3);
function save_product_meta_fields($post_id, $post, $update) {
	// Проверка автосохранения
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	
	// Проверка прав (усиленная)
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	
	// Проверка revision
	if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
		return;
	}
	
	// Сохранение основных полей с проверкой nonce
	if (isset($_POST['product_meta_box_nonce']) && wp_verify_nonce($_POST['product_meta_box_nonce'], 'product_meta_box_action')) {
		
		// Числовые поля с валидацией диапазонов
		$numeric_fields = array(
			'_product_rent_price' => array('min' => 0, 'max' => 999999999),
			'_product_purchase_price' => array('min' => 0, 'max' => 999999999),
			'_product_power_nominal' => array('min' => 0, 'max' => 10000),
			'_product_power_base' => array('min' => 0, 'max' => 10000),
			'_product_power_max' => array('min' => 0, 'max' => 10000),
			'_product_fuel_nominal' => array('min' => 0, 'max' => 1000),
			'_product_fuel_base' => array('min' => 0, 'max' => 1000),
			'_product_fuel_max' => array('min' => 0, 'max' => 1000),
			'_product_tank_volume' => array('min' => 0, 'max' => 10000),
			'_product_noise' => array('min' => 0, 'max' => 200),
			'_product_length' => array('min' => 0, 'max' => 10000),
			'_product_width' => array('min' => 0, 'max' => 10000),
			'_product_height' => array('min' => 0, 'max' => 10000),
			'_product_weight' => array('min' => 0, 'max' => 100000)
		);
		
		foreach ($numeric_fields as $field => $range) {
			if (isset($_POST[$field])) {
				$value = floatval($_POST[$field]);
				// Валидация диапазона
				$value = max($range['min'], min($range['max'], $value));
				update_post_meta($post_id, $field, $value);
			}
		}
		
		// Строковое поле с усиленной санитизацией
		if (isset($_POST['_product_execution'])) {
			$execution = sanitize_text_field($_POST['_product_execution']);
			$execution = wp_kses_post($execution);
			// Ограничение длины
			$execution = substr($execution, 0, 255);
			update_post_meta($post_id, '_product_execution', $execution);
		}
		
		// Чекбокс
		$in_stock = isset($_POST['_product_in_stock']) ? '1' : '0';
		update_post_meta($post_id, '_product_in_stock', $in_stock);
	}
	
	// Сохранение галереи с проверкой nonce
	if (isset($_POST['product_gallery_meta_box_nonce']) && wp_verify_nonce($_POST['product_gallery_meta_box_nonce'], 'product_gallery_meta_box_action')) {
		
		if (isset($_POST['_product_gallery'])) {
			// Ограничение размера входных данных
			$gallery_data = sanitize_text_field($_POST['_product_gallery']);
			if (strlen($gallery_data) > 10000) {
				$gallery_data = substr($gallery_data, 0, 10000);
			}
			
			$gallery_ids = array_filter(array_map('intval', explode(',', $gallery_data)));
			
			// Проверка, что все ID действительно существуют и являются изображениями
			$valid_ids = array();
			foreach ($gallery_ids as $id) {
				$attachment = get_post($id);
				if ($attachment && $attachment->post_type === 'attachment' && strpos($attachment->post_mime_type, 'image/') === 0) {
					$valid_ids[] = $id;
				}
			}
			
			// Ограничиваем до 10 изображений
			if (count($valid_ids) > 10) {
				$valid_ids = array_slice($valid_ids, 0, 10);
			}
			
			update_post_meta($post_id, '_product_gallery', $valid_ids);
		} else {
			update_post_meta($post_id, '_product_gallery', array());
		}
	}

	// Сохранение файлов с проверкой nonce
	if (isset($_POST['product_files_meta_box_nonce']) && wp_verify_nonce($_POST['product_files_meta_box_nonce'], 'product_files_meta_box_action')) {

		$links = array();

		if (isset($_POST['_product_links']) && is_array($_POST['_product_links'])) {
			foreach ($_POST['_product_links'] as $link_data) {
				if (!is_array($link_data)) {
					continue;
				}
				
				$url = isset($link_data['url']) ? trim($link_data['url']) : '';
				$text = isset($link_data['text']) ? trim($link_data['text']) : '';
				
				// Пропускаем пустые URL
				if (empty($url)) {
					continue;
				}
				
				// Валидация URL
				$url = esc_url_raw($url);
				
				// Дополнительная проверка на опасные протоколы
				if (!empty($url)) {
					$parsed = parse_url($url);
					if (isset($parsed['scheme'])) {
						$scheme = strtolower($parsed['scheme']);
						if (!in_array($scheme, ['http', 'https'])) {
							continue;
						}
					}
					
					// Опциональная проверка заблокированных доменов
					$blocked_domains = array('malware.example.com', 'phishing.example.com');
					if (isset($parsed['host'])) {
						foreach ($blocked_domains as $blocked) {
							if (strpos($parsed['host'], $blocked) !== false) {
								continue 2;
							}
						}
					}
					
					// Санитизация текста ссылки
					if (!empty($text)) {
						$text = sanitize_text_field($text);
						$text = wp_kses_post($text);
						$text = substr($text, 0, 255);
					}
					
					$links[] = array(
						'url' => $url,
						'text' => $text
					);
				}
			}
		}
		
		// Ограничение количества ссылок (максимум 50)
		if (count($links) > 50) {
			$links = array_slice($links, 0, 50);
		}
		
		update_post_meta($post_id, '_product_links', $links);
	}
}

// Предупреждение выхода с несохранёнными изменениями (исправленная версия)
add_action('admin_footer-post.php', 'add_wordpress_unsaved_warning');
add_action('admin_footer-post-new.php', 'add_wordpress_unsaved_warning');
function add_wordpress_unsaved_warning() {
	global $post;
	if (!$post || $post->post_type !== 'product') {
		return;
	}
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var changesDetected = false;
		
		function trackAllChanges() {
			// Отслеживаем изменения в стандартных полях
			$('#title, #content, #excerpt, input[type="text"], input[type="number"], input[type="url"], textarea, select').on('change input', function() {
				changesDetected = true;
			});
			
			// Отслеживаем чекбоксы и радио
			$('input[type="checkbox"], input[type="radio"]').on('change', function() {
				changesDetected = true;
			});
			
			// Отслеживаем изменения в галерее
			$(document).on('click', '#add_gallery_image', function() {
				changesDetected = true;
			});
			
			$(document).on('click', '.remove-image', function() {
				changesDetected = true;
			});
			
			$(document).on('sortupdate', '#gallery_images_list', function() {
				changesDetected = true;
			});
			
			// Отслеживаем изменения в списке ссылок
			$(document).on('click', '#add_link_btn', function() {
				changesDetected = true;
			});
			
			$(document).on('click', '.remove-link', function() {
				changesDetected = true;
			});
			
			$(document).on('change input', '#new_link_input', function() {
				if ($(this).val()) {
					changesDetected = true;
				}
			});
			
			$(document).on('change input', 'input[name="_product_links[]"]', function() {
				changesDetected = true;
			});
		}
		
		trackAllChanges();
		
		$('form#post').on('submit', function() {
			changesDetected = false;
			window.onbeforeunload = null;
		});
		
		window.addEventListener('beforeunload', function(e) {
			if (changesDetected) {
				e.preventDefault();
				e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
				return e.returnValue;
			}
		});
		
		$('#publish, #save-post, #save-action button, #minor-publishing-actions .save-action button').on('click', function() {
			changesDetected = false;
		});
	});
	</script>
	<?php
}

// Подключение медиа-библиотеки для галереи
add_action('admin_enqueue_scripts', 'enqueue_media_for_gallery');
function enqueue_media_for_gallery($hook) {
	global $post;
	if (($hook == 'post.php' || $hook == 'post-new.php') && isset($post) && $post->post_type == 'product') {
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-sortable');
	}
}

// Безопасные функции для получения значений в редакторе (с проверкой прав)
function get_product_rent_price($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	$value = get_post_meta($post_id, '_product_rent_price', true);
	return (!empty($value) || $value === '0') ? floatval($value) : 0;
}

function get_product_purchase_price($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	$value = get_post_meta($post_id, '_product_purchase_price', true);
	return (!empty($value) || $value === '0') ? floatval($value) : 0;
}

function is_product_in_stock($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return get_post_meta($post_id, '_product_in_stock', true) === '1';
}

function get_product_gallery($post_id = null, $image_idx = null) {
	if (!$post_id) $post_id = get_the_ID();
	$gallery = get_post_meta($post_id, '_product_gallery', true);
	if ($image_idx === null) {
		return is_array($gallery) ? array_map('absint', $gallery) : array();
	} else {
		return is_array($gallery) && sizeof($gallery) > 0 ? absint($gallery[$image_idx]) : '';
	}
}

function get_product_power_nominal($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_power_nominal', true));
}

function get_product_power_base($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_power_base', true));
}

function get_product_power_max($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_power_max', true));
}

function get_product_fuel_nominal($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_fuel_nominal', true));
}

function get_product_fuel_base($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_fuel_base', true));
}

function get_product_fuel_max($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_fuel_max', true));
	}
	
function get_product_tank_volume($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_tank_volume', true));
}

function get_product_length($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_length', true));
}
function get_product_width($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_width', true));
}
function get_product_height($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_height', true));
}
function get_product_weight($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	return floatval(get_post_meta($post_id, '_product_weight', true));
}

function get_product_noise($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	$noise = get_post_meta($post_id, '_product_noise', true);
	return (!empty($noise) || $noise === '0') ? floatval($noise) : 97;
}

function get_product_execution($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	$execution = get_post_meta($post_id, '_product_execution', true);
	return !empty($execution) ? sanitize_text_field($execution) : 'в кожухе';
}

function get_product_links($post_id = null) {
	if (!$post_id) $post_id = get_the_ID();
	$links = get_post_meta($post_id, '_product_links', true);
	if (!is_array($links)) {
		return array();
	}
	
	$safe_links = array();
	foreach ($links as $link) {
		if (isset($link['url']) && !empty($link['url'])) {
			$safe_links[] = array(
				'url' => esc_url_raw($link['url']),
				'text' => isset($link['text']) ? sanitize_text_field($link['text']) : ''
			);
		}
	}
	return $safe_links;
}

// Дополнительная функция для очистки неиспользуемых мета-полей при удалении продукта
add_action('before_delete_post', 'cleanup_product_meta_fields');
function cleanup_product_meta_fields($post_id) {
	global $post_type;
	if ($post_type !== 'product') {
		return;
	}
	
	$meta_fields = array(
		'_product_gallery',
		'_product_rent_price',
		'_product_purchase_price',
		'_product_power_nominal',
		'_product_power_base',
		'_product_power_max',
		'_product_fuel_nominal',
		'_product_fuel_base',
		'_product_fuel_max',
		'_product_tank_volume',
		'_product_noise',
		'_product_execution',
		'_product_in_stock',
		'_product_length',
		'_product_width',
		'_product_height',
		'_product_weight',
		'_product_links'
	);
	
	foreach ($meta_fields as $field) {
		delete_post_meta($post_id, $field);
	}
}
?>