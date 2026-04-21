<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('main_banner', [
		'title'    => 'Блок «Главный баннер»',
		'priority' => 20,
		'panel' => 'sections_panel'
	]);

	$icons_list = custom_get_icons_options();

	// Heading
	$wp_customize->add_setting( 'main_banner__heading', array(
		'default'           => Theme_Defaults::MAIN_BANNER_HEADING,
	) );
	
	$wp_customize->add_control( 'main_banner__heading', array(
		'label'       => __( 'Заголовок', THEME_PREFIX ),
		'section'     => 'main_banner',
		'type'        => 'text',
	) );

	// Description
	$wp_customize->add_setting( 'main_banner__description', array(
		'default'           => Theme_Defaults::MAIN_BANNER_DESCRIPTION,
	) );
	
	$wp_customize->add_control( 'main_banner__description', array(
		'label'       => __( 'Описание', THEME_PREFIX ),
		'section'     => 'main_banner',
		'type'        => 'text',
	) );

	// Thumbnail
	$wp_customize->add_setting('main_banner__thumbnail', [
		'default'           => Theme_Defaults::MAIN_BANNER_THUMBNAIL,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage'
	]);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'main_banner__thumbnail', [
		'label'    => __('Обложка', THEME_PREFIX),
		'section'  => 'main_banner',
		'settings' => 'main_banner__thumbnail',
		'description' => __('Загрузите изображение генератора или другую обложку без фона в формате PNG', THEME_PREFIX),
	]));

	// Accent Button
	$wp_customize->add_setting('main_banner__button1_icon', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON1_ICON
	]);

	$wp_customize->add_control('main_banner__button1_icon', [
		'type'    => 'select',
		'section' => 'main_banner',
		'label'   => __('Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	$wp_customize->add_setting('main_banner__button1_name', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON1_NAME
	]);

	$wp_customize->add_control('main_banner__button1_name', [
		'type'    => 'text',
		'section' => 'main_banner',
		'label'   => __('Текст акцентной кнопки', THEME_PREFIX),
	]);

	$wp_customize->add_setting('main_banner__button1_link', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON1_LINK
	]);

	$wp_customize->add_control('main_banner__button1_link', [
		'type'    => 'text',
		'section' => 'main_banner',
		'label'   => __('Ссылка акцентной кнопки', THEME_PREFIX),
	]);

	// Secondary Button
	$wp_customize->add_setting('main_banner__button2_icon', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON2_ICON
	]);

	$wp_customize->add_control('main_banner__button2_icon', [
		'type'    => 'select',
		'section' => 'main_banner',
		'label'   => __('Иконка дополнительной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	$wp_customize->add_setting('main_banner__button2_name', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON2_NAME
	]);

	$wp_customize->add_control('main_banner__button2_name', [
		'type'    => 'text',
		'section' => 'main_banner',
		'label'   => __('Текст дополнительной кнопки', THEME_PREFIX),
	]);

	$wp_customize->add_setting('main_banner__button2_link', [
		'default'           => Theme_Defaults::MAIN_BANNER_BUTTON2_LINK
	]);

	$wp_customize->add_control('main_banner__button2_link', [
		'type'    => 'text',
		'section' => 'main_banner',
		'label'   => __('Ссылка дополнительной кнопки', THEME_PREFIX),
	]);

});