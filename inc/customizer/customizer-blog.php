<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('blog', [
		'title'    => 'Раздел «Блог»',
		'description' => 'Общие настройки раздела',
		'priority' => 10,
		'panel' => 'sections_panel'
	]);

	// Heading
	$wp_customize->add_setting('blog__heading', [
		'default'           => Theme_Defaults::BLOG_HEADING
	]);

	$wp_customize->add_control('blog__heading', [
		'type'    => 'text',
		'section' => 'blog',
		'label'   => __('Заголовок', THEME_PREFIX),
	]);

	// Link
	$wp_customize->add_setting('blog__link', [
		'default'           => Theme_Defaults::BLOG_LINK
	]);

	$wp_customize->add_control('blog__link', [
		'type'        => 'text',
		'section'     => 'blog',
		'label'       => __('Ссылка на раздел', THEME_PREFIX),
		'description' => __('Укажите ссылку на страницу Блога', THEME_PREFIX),
	]);

	// Answer to Empty
	$wp_customize->add_setting('blog__answer_to_empty', [
		'default'           => Theme_Defaults::BLOG_ANSWER_TO_EMPTY
	]);

	$wp_customize->add_control('blog__answer_to_empty', [
		'type'        => 'text',
		'section'     => 'blog',
		'label'       => __('Текст при отсутствии материалов', THEME_PREFIX),
		'description' => __('Укажите текст, который будет отображаться, если публикации для раздела не найдены. Особенно актуально для Рубрик', THEME_PREFIX),
	]);

	// Show sidebar
	$wp_customize->add_setting( 'blog__show_sidebar', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::BLOG_SHOW_SIDEBAR,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'blog__show_sidebar', array(
		'label'       => __( 'Показывать сайдбар с описанием блога', THEME_PREFIX ),
		'section'     => 'blog',
		'type'        => 'checkbox',
	) );

	// Description
	$wp_customize->add_setting('blog__description', [
		'default' => Theme_Defaults::BLOG_DESCRIPTION
	]);
	
	$wp_customize->add_control('blog__description', [
		'type'    => 'textarea',
		'section' => 'blog',
		'label'   => __('Опиание блога', THEME_PREFIX),
		'description' => __('Отображается в сайдбаре', THEME_PREFIX),
	]);

	// Thumbnail
	$wp_customize->add_setting('blog__thumbnail', [
		'default'           => Theme_Defaults::BLOG_THUMBNAIL,
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage'
	]);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blog__thumbnail', [
		'label'    => __('Обложка блога', THEME_PREFIX),
		'section'  => 'blog',
		'settings' => 'blog__thumbnail',
		'description' => __('Загрузите изображение, учтите, что оно обрежется до пропорций 1:1', THEME_PREFIX),
	]));
});