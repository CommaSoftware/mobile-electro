<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('cases', [
		'title'    => 'Блок «Проекты»',
		'description' => 'Список индустрий с ссылкой на раздел реализованнных проектов. Перечнь и описаний индустрий задаётся в разделе <a href="/wp-admin/edit-tags.php?taxonomy=industries">«Индустрии»</a>',
		'priority' => 22,
		'panel' => 'sections_panel'
	]);

	// Show block
	$wp_customize->add_setting( 'cases__show', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::CASES_SHOW,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'cases__show', array(
		'label'       => __( 'Показывать блок на главной странице', THEME_PREFIX ),
		'section'     => 'cases',
		'type'        => 'checkbox',
	) );

	// Heading
	$wp_customize->add_setting('cases__heading', [
		'default'           => Theme_Defaults::CASES_HEADING
	]);

	$wp_customize->add_control('cases__heading', [
		'type'    => 'text',
		'section' => 'cases',
		'label'   => __('Заголовок', THEME_PREFIX),
	]);

	// Description
	$wp_customize->add_setting('cases__description', [
		'default'           => Theme_Defaults::CASES_DESCRIPTION
	]);

	$wp_customize->add_control('cases__description', [
		'type'    => 'text',
		'section' => 'cases',
		'label'   => __('Описание', THEME_PREFIX),
	]);

	// Thumbnail
	$wp_customize->add_setting('cases__thumbnail', [
		'default'           => Theme_Defaults::CASES_THUMBNAIL,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage'
	]);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cases__thumbnail', [
		'label'    => __('Обложка', THEME_PREFIX),
		'section'  => 'cases',
		'settings' => 'cases__thumbnail',
		'description' => __('Загрузите изображение, учтите, что оно обрежется до пропорций 1:1', THEME_PREFIX),
	]));

	// Links
	$wp_customize->add_setting('cases__link', [
		'default'           => Theme_Defaults::CASES_LINK
	]);

	$wp_customize->add_control('cases__link', [
		'type'        => 'text',
		'section'     => 'cases',
		'label'       => __('Ссылка на раздел «Проекты»', THEME_PREFIX),
		'description' => __('Используется для перехода по нажатиию на любой из элементов списка Индустрий', THEME_PREFIX),
	]);
});