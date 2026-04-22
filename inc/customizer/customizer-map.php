<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('map', [
		'title'    => 'Блок «Карта»',
		'priority' => 23,
		'panel' => 'sections_panel'
	]);

	$icons_list = custom_get_icons_options();
	
	$wp_customize->add_setting( 'map__show', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::MAP_SHOW,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'map__show', array(
		'label'       => __( 'Показывать блок на главной странице', THEME_PREFIX ),
		'section'     => 'map',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'map__heading', array(
		'default' => Theme_Defaults::MAP_HEADING,
	) );
	$wp_customize->add_control( 'map__heading', array(
		'label'       => __( 'Заголовок', THEME_PREFIX ),
		'section'     => 'map',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'map__description', array(
		'default' => Theme_Defaults::MAP_DESCRIPTION,
	) );
	$wp_customize->add_control( 'map__description', array(
		'label'       => __( 'Описание', THEME_PREFIX ),
		'section'     => 'map',
		'type'        => 'text',
	) );

	// Button

	$wp_customize->add_setting('map__button_icon', [
		'default'           => Theme_Defaults::MAP_BUTTON_ICON
	]);

	$wp_customize->add_control('map__button_icon', [
		'type'    => 'select',
		'section' => 'header',
		'label'   => __('Иконка кнопки действия', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	$wp_customize->add_setting('map__button_name', [
		'default'           => Theme_Defaults::MAP_BUTTON_NAME
	]);

	$wp_customize->add_control('map__button_name', [
		'type'    => 'text',
		'section' => 'header',
		'label'   => __('Текст кнопки действия', THEME_PREFIX),
	]);

	$wp_customize->add_setting('map__button_link', [
		'default'           => Theme_Defaults::MAP_BUTTON_LINK
	]);

	$wp_customize->add_control('map__button_link', [
		'type'    => 'text',
		'section' => 'header',
		'label'   => __('Ссылка кнопки действия', THEME_PREFIX),
	]);
});