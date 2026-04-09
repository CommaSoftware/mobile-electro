<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('article_sidebar', [
		'title'    => 'Сайдбар статьи',
		'priority' => 20,
		'panel' => 'sections_panel'
	]);

	$icons_list = custom_get_icons_options();

	// Show Sidebar Checkbox
	$wp_customize->add_setting( 'article_sidebar__show', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_SHOW,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'article_sidebar__show', array(
		'label'       => __( 'Отображать сайдбар', THEME_PREFIX ),
		'description' => __( 'Отметьте, чтобы включить сайдбар на странице публикаций', THEME_PREFIX ),
		'section'     => 'article_sidebar',
		'type'        => 'checkbox',
	) );

	// Title
	$wp_customize->add_setting('article_sidebar__title', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_TITLE
	]);
	$wp_customize->add_control('article_sidebar__title', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Заголовок сайдбара', THEME_PREFIX),
	]);

	// Description
	$wp_customize->add_setting('article_sidebar__description', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_DESCRIPTION
	]);
	$wp_customize->add_control('article_sidebar__description', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Описание сайдбара', THEME_PREFIX),
	]);

	// Accent Button
	$wp_customize->add_setting('article_sidebar__button1_icon', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_ICON
	]);

	$wp_customize->add_control('article_sidebar__button1_icon', [
		'type'    => 'select',
		'section' => 'article_sidebar',
		'label'   => __('Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	$wp_customize->add_setting('article_sidebar__button1_name', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_NAME
	]);

	$wp_customize->add_control('article_sidebar__button1_name', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Текст акцентной кнопки', THEME_PREFIX),
	]);

	$wp_customize->add_setting('article_sidebar__button1_link', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_LINK
	]);

	$wp_customize->add_control('article_sidebar__button1_link', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Ссылка акцентной кнопки', THEME_PREFIX),
	]);

	// Secondary Button
	$wp_customize->add_setting('article_sidebar__button2_icon', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_ICON
	]);

	$wp_customize->add_control('article_sidebar__button2_icon', [
		'type'    => 'select',
		'section' => 'article_sidebar',
		'label'   => __('Иконка дополнительной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	$wp_customize->add_setting('article_sidebar__button2_name', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_NAME
	]);

	$wp_customize->add_control('article_sidebar__button2_name', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Текст дополнительной кнопки', THEME_PREFIX),
	]);

	$wp_customize->add_setting('article_sidebar__button2_link', [
		'default'           => Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_LINK
	]);

	$wp_customize->add_control('article_sidebar__button2_link', [
		'type'    => 'text',
		'section' => 'article_sidebar',
		'label'   => __('Ссылка дополнительной кнопки', THEME_PREFIX),
	]);
});