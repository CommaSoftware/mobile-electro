<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('advantages', [
		'title'    => 'Блок «Преимущества»',
		'priority' => 21,
		'panel' => 'sections_panel'
	]);

	$icons_list = custom_get_icons_options();
	
	$wp_customize->add_setting( 'advantages__show', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::ADVANTAGES_SHOW,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'advantages__show', array(
		'label'       => __( 'Показывать блок на главной странице', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'checkbox',
	) );

	// Item 1
	$wp_customize->add_setting( 'advantages__item1_heading', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM1_HEADING,
	) );
	$wp_customize->add_control( 'advantages__item1_heading', array(
		'label'       => __( '№1 Заголовок', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'advantages__item1_description', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM1_DESCRIPTION,
	) );
	$wp_customize->add_control( 'advantages__item1_description', array(
		'label'       => __( '№1 Описание', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting('advantages__item1_icon', [
		'default' => Theme_Defaults::ADVANTAGES_ITEM1_ICON
	]);

	$wp_customize->add_control('advantages__item1_icon', [
		'type'    => 'select',
		'section' => 'advantages',
		'label'   => __('№1 Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);
	
	// Item 2
	$wp_customize->add_setting( 'advantages__item2_heading', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM2_HEADING,
	) );
	$wp_customize->add_control( 'advantages__item2_heading', array(
		'label'       => __( '№2 Заголовок', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'advantages__item2_description', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM2_DESCRIPTION,
	) );
	$wp_customize->add_control( 'advantages__item2_description', array(
		'label'       => __( '№2 Описание', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting('advantages__item2_icon', [
		'default' => Theme_Defaults::ADVANTAGES_ITEM2_ICON
	]);

	$wp_customize->add_control('advantages__item2_icon', [
		'type'    => 'select',
		'section' => 'advantages',
		'label'   => __('№2 Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);
		
	// Item 3
	$wp_customize->add_setting( 'advantages__item3_heading', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM3_HEADING,
	) );
	$wp_customize->add_control( 'advantages__item3_heading', array(
		'label'       => __( '№3 Заголовок', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'advantages__item3_description', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM3_DESCRIPTION,
	) );
	$wp_customize->add_control( 'advantages__item3_description', array(
		'label'       => __( '№3 Описание', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting('advantages__item3_icon', [
		'default' => Theme_Defaults::ADVANTAGES_ITEM3_ICON
	]);

	$wp_customize->add_control('advantages__item3_icon', [
		'type'    => 'select',
		'section' => 'advantages',
		'label'   => __('№3 Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);

	// Item 4
	$wp_customize->add_setting( 'advantages__item4_heading', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM4_HEADING,
	) );
	$wp_customize->add_control( 'advantages__item4_heading', array(
		'label'       => __( '№4 Заголовок', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'advantages__item4_description', array(
		'default' => Theme_Defaults::ADVANTAGES_ITEM4_DESCRIPTION,
	) );
	$wp_customize->add_control( 'advantages__item4_description', array(
		'label'       => __( '№4 Описание', THEME_PREFIX ),
		'section'     => 'advantages',
		'type'        => 'text',
	) );

	$wp_customize->add_setting('advantages__item4_icon', [
		'default' => Theme_Defaults::ADVANTAGES_ITEM4_ICON
	]);

	$wp_customize->add_control('advantages__item4_icon', [
		'type'    => 'select',
		'section' => 'advantages',
		'label'   => __('№4 Иконка акцентной кнопки', THEME_PREFIX),
		'choices' => $icons_list,
	]);
});