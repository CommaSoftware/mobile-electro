<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('footer', [
		'title'    => 'Подвал',
		'priority' => 11,
		'panel' => 'sections_panel'
	]);

	// Filter Logo
	$wp_customize->add_setting('footer__logo', [
		'default'           => Theme_Defaults::FOOTER_LOGO,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage'
	]);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer__logo', [
		'label'    => __('Логотип в подвале', THEME_PREFIX),
		'section'  => 'footer',
		'settings' => 'footer__logo',
		'description' => __('Загрузите логотип сайта', THEME_PREFIX),
	]));

	// Accent Button
	// $wp_customize->add_setting('header__button1_icon', [
	// 	'default'           => Theme_Defaults::HEADER_BUTTON1_ICON,
	// 	'sanitize_callback' => 'sanitize_text_field',
	// 	'transport'         => 'postMessage',
	// ]);

	// $wp_customize->add_control('header__button1_icon', [
	// 	'type'    => 'select',
	// 	'section' => 'header',
	// 	'label'   => __('Иконка акцентной кнопки', THEME_PREFIX),
	// 	'choices' => $icons_list,
	// ]);
});