<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('product_view', [
		'title'    => 'Блок «Популярные модели»',
		'description' => 'Выводит последние опубликованные материалы типа «Генераторы», для закрепления определённого генератора можно изменить дату публикации',
		'priority' => 40,
		'panel' => 'sections_panel'
	]);

	// Show block
	$wp_customize->add_setting( 'product_view__show_on_front', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::PRODUCT_VIEW_SHOW_ON_FRONT,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'product_view__show_on_front', array(
		'label'       => __( 'Показывать блок на главной странице', THEME_PREFIX ),
		'section'     => 'product_view',
		'type'        => 'checkbox',
	) );

	// Heading
	$wp_customize->add_setting('product_view__heading', [
		'default'           => Theme_Defaults::PRODUCT_VIEW_HEADING
	]);

	$wp_customize->add_control('product_view__heading', [
		'type'    => 'text',
		'section' => 'product_view',
		'label'   => __('Заголовок', THEME_PREFIX),
	]);

	// Description
	$wp_customize->add_setting('product_view__description', [
		'default'           => Theme_Defaults::PRODUCT_VIEW_DESCRIPTION
	]);

	$wp_customize->add_control('product_view__description', [
		'type'    => 'text',
		'section' => 'product_view',
		'label'   => __('Описание', THEME_PREFIX),
	]);
});