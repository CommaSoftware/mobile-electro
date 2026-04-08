<?php

class Mobilelectro_Page_Creator {
	
	private $pages_to_create = [
		'about' => [
			'title'    => 'О нас',
			'template' => 'about-page.php',
		],
		'privacy-policy' => [
			'title'    => 'Политика конфиденциальности',
			'template' => '',
		],
	];
	
	const PAGES_CREATED_OPTION = 'mobilelectro_pages_created';
	public function __construct() {
			add_action('after_switch_theme', [$this, 'create_required_pages']);
	}
	
	public function create_required_pages() {
		// Проверяем, были ли уже созданы страницы
		if (get_option(self::PAGES_CREATED_OPTION, false)) {
			return;
		}
		
		$created_pages = [];
		foreach ($this->pages_to_create as $slug => $page_data) {
			$page_id = $this->create_page($slug, $page_data);
			
			if ($page_id) {
				$created_pages[$slug] = $page_id;
			}
		}
		
		// Сохраняем флаг, что страницы созданы
		if (!empty($created_pages)) {
			update_option(self::PAGES_CREATED_OPTION, $created_pages);
			
			// Обновляем правила пермалинков
			flush_rewrite_rules();
		}
	}
	
	/**
	 * Создание отдельной страницы
	 *
	 * @param string $slug URL страницы
	 * @param array  $page_data Данные страницы
	 * @return int|false ID созданной страницы или false
	 */
	private function create_page($slug, $page_data) {
		// Проверяем существование страницы по slug
		$existing_page = get_page_by_path($slug);
		
		if ($existing_page) {
			// Страница уже существует, возвращаем её ID
			return $existing_page->ID;
		}
		
		// Подготавливаем данные для вставки
		$page_args = [
			'post_title'   => $page_data['title'],
			'post_name'    => $slug,
			'post_content' => $this->get_default_content($slug),
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_author'  => 1, // ID администратора
		];
		
		// Вставляем страницу в базу данных
		$page_id = wp_insert_post($page_args);
		
		if (is_wp_error($page_id)) {
			return false;
		}
		
		// Назначаем шаблон страницы, если он указан
		if (!empty($page_data['template']) && $page_id) {
			update_post_meta($page_id, '_wp_page_template', $page_data['template']);
		}
		
		return $page_id;
	}
	
	/**
	 * Получение содержимого по умолчанию для страницы
	 *
	 * @param string $slug URL страницы
	 * @return string
	 */
	private function get_default_content($slug) {
		$contents = [
			'about' => '
				<h2>О нашей компании</h2>
				<p>Мы профессиональная команда, специализирующаяся на создании качественных веб-решений.</p>
				<h3>Наша миссия</h3>
				<p>Предоставлять лучшие услуги нашим клиентам.</p>
			',
		];
		
		return isset($contents[$slug]) ? $contents[$slug] : '';
	}
	
	/**
	 * Получение ID созданной страницы по slug
	 *
	 * @param string $slug
	 * @return int|false
	 */
	public static function get_page_id($slug) {
		$created_pages = get_option(self::PAGES_CREATED_OPTION, []);
		
		if (isset($created_pages[$slug])) {
			return $created_pages[$slug];
		}
		
		$page = get_page_by_path($slug);
		return $page ? $page->ID : false;
	}
	
	/**
	 * Получение URL страницы по slug
	 *
	 * @param string $slug
	 * @return string
	 */
	public static function get_page_url($slug) {
		$page_id = self::get_page_id($slug);
		
		if ($page_id) {
			return get_permalink($page_id);
		}
		
		return '#';
	}
	
	/**
	 * Удаление созданных страниц (опционально, при деактивации)
	 */
	public static function delete_created_pages() {
		$created_pages = get_option(self::PAGES_CREATED_OPTION, []);
		
		foreach ($created_pages as $slug => $page_id) {
			wp_delete_post($page_id, true);
		}
		
		delete_option(self::PAGES_CREATED_OPTION);
		flush_rewrite_rules();
	}
}

new Mobilelectro_Page_Creator();