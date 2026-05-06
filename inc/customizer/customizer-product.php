<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('product', [
		'title'    => 'Генераторы: Страница продукта',
		'description' => 'Общие настройки для всех генераторов',
		'priority' => 60,
		'panel' => 'sections_panel'
	]);

	// Buy link
	$wp_customize->add_setting('product__buy_link', [
		'default'           => Theme_Defaults::PRODUCT_BUY_LINK
	]);

	$wp_customize->add_control('product__buy_link', [
		'type'        => 'text',
		'section'     => 'product',
		'label'       => __('Ссылка на форму покупки или аренды', THEME_PREFIX),
	]);

	// Delivery name
	$wp_customize->add_setting('product__delivery_name', [
		'default'           => Theme_Defaults::PRODUCT_DELIVERY_NAME
	]);

	$wp_customize->add_control('product__delivery_name', [
		'type'        => 'text',
		'section'     => 'product',
		'label'       => __('Текст кнопки об условиях доставки', THEME_PREFIX),
	]);
	
	// Delivery link
	$wp_customize->add_setting('product__delivery_link', [
		'default'           => Theme_Defaults::PRODUCT_DELIVERY_LINK
	]);

	$wp_customize->add_control('product__delivery_link', [
		'type'        => 'text',
		'section'     => 'product',
		'label'       => __('Ссылка на страницу об условиях доставки', THEME_PREFIX),
	]);

	// Rate list
	$wp_customize->add_setting('product__rate_list', [
		'default'           => Theme_Defaults::PRODUCT_RATE_LIST
	]);

	$wp_customize->add_control('product__rate_list', [
		'type'        => 'textarea',
		'section'     => 'product',
		'label'       => __('Текст блока «Тарифы аренды»', THEME_PREFIX),
		'description' => __('Введите текст. Для использования форматирования используйте HTML разметку', THEME_PREFIX),
	]);

	// Rent instruction
	$wp_customize->add_setting('product__rent_instruction', [
		'default'           => Theme_Defaults::PRODUCT_RENT_INSTRUCTION
	]);

	$wp_customize->add_control('product__rent_instruction', [
		'type'        => 'textarea',
		'section'     => 'product',
		'label'       => __('Текст блока «Как купить или взять в аренду»', THEME_PREFIX),
		'description' => __('Введите текст. Для использования форматирования используйте HTML разметку', THEME_PREFIX),
	]);
});