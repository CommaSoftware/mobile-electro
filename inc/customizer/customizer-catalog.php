<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('catalog', [
		'title'    => 'Раздел «Каталог»',
		'description' => 'Общие настройки раздела',
		'priority' => 11,
		'panel' => 'sections_panel'
	]);

	// Link
	$wp_customize->add_setting('catalog__link', [
		'default'           => Theme_Defaults::CATALOG_LINK
	]);

	$wp_customize->add_control('catalog__link', [
		'type'        => 'text',
		'section'     => 'catalog',
		'label'       => __('Ссылка на раздел', THEME_PREFIX),
		'description' => __('Укажите ссылку на страницу Каталога', THEME_PREFIX),
	]);
});