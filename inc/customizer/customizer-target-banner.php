<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('target_banner', [
		'title'    => 'Блок «Баннер покупки и аренды»',
		'priority' => 20,
		'panel' => 'sections_panel'
	]);

	// Shortcode
	$wp_customize->add_setting( 'target_banner__shortcode', array(
		'default'           => Theme_Defaults::TARGET_FORM_SHORTCODE,
	) );
	
	$wp_customize->add_control( 'target_banner__shortcode', array(
		'label'       => __( 'Шорткод формы обратной связи', THEME_PREFIX ),
		'description' => __( "<a href='#!' onclick='navigator.clipboard.writeText(`".Theme_Defaults::TARGET_BANNER_FORM_HTML."`)'>Скопировать код формы для плагина Contact form 7</a>", THEME_PREFIX ),
		'section'     => 'target_banner',
		'type'        => 'text',
	) );

	// Heading
	$wp_customize->add_setting( 'target_banner__heading', array(
		'default'           => Theme_Defaults::TARGET_BANNER_HEADING,
	) );
	
	$wp_customize->add_control( 'target_banner__heading', array(
		'label'       => __( 'Заголовок', THEME_PREFIX ),
		'section'     => 'target_banner',
		'type'        => 'text',
	) );

	// Description
	$wp_customize->add_setting( 'target_banner__description', array(
		'default'           => Theme_Defaults::TARGET_BANNER_DESCRIPTION,
	) );
	
	$wp_customize->add_control( 'target_banner__description', array(
		'label'       => __( 'Описание', THEME_PREFIX ),
		'section'     => 'target_banner',
		'type'        => 'text',
	) );

	// Thumbnail
	$wp_customize->add_setting('target_banner__thumbnail', [
		'default'           => Theme_Defaults::TARGET_BANNER_THUMBNAIL,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage'
	]);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'target_banner__thumbnail', [
		'label'    => __('Обложка', THEME_PREFIX),
		'section'  => 'target_banner',
		'settings' => 'target_banner__thumbnail',
		'description' => __('Загрузите изображение генератора или другую обложку без фона в формате PNG', THEME_PREFIX),
	]));

	// Slider items
	$wp_customize->add_section( 'gallery_section', array(
		'title'    => __( 'Галерея изображений', 'textdomain' ),
		'priority' => 30,
	) );
	
	for ( $i = 1; $i <= Theme_Defaults::TARGET_BANNER_MAX_SLIDER_ITEMS; $i++ ) {
		// Heading
		$wp_customize->add_setting( "target_banner__slider_item{$i}__heading", array(
			'default'           => "",
		) );
		
		$wp_customize->add_control( "target_banner__slider_item{$i}__heading", array(
			'label'       => __( "Элемент слайдера №{$i}: Заголовок", THEME_PREFIX ),
			'section'     => 'target_banner',
			'type'        => 'text',
		) );

		// Description
		$wp_customize->add_setting( "target_banner__slider_item{$i}__description", array(
			'default'           => "",
		) );
		
		$wp_customize->add_control( "target_banner__slider_item{$i}__description", array(
			'label'       => __( "Элемент слайдера №{$i}: Описание", THEME_PREFIX ),
			'section'     => 'target_banner',
			'type'        => 'text',
		) );
	}
});