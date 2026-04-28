<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('header_top_line', [
		'title'    => 'Шапка: Строка с телефоном',
		'description' => 'Отображает фиксированную строку со стационарным телефоном выше шапки (только для планшетов и смартфонов)',
		'priority' => 2,
		'panel' => 'sections_panel'
	]);

	// Show block
	$wp_customize->add_setting( 'header_top_line__show', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::HEADER_TOP_LINE_SHOW,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'header_top_line__show', array(
		'label'       => __( 'Показывать строку с телефоном', THEME_PREFIX ),
		'section'     => 'header_top_line',
		'type'        => 'checkbox',
	) );

	// Labels
	$wp_customize->add_setting('header_top_line__full_label', [
		'default'           => Theme_Defaults::HEADER_TOP_LINE_FULL_LABEL
	]);

	$wp_customize->add_control('header_top_line__full_label', [
		'type'    => 'text',
		'section' => 'header_top_line',
		'label'   => __('Строка описания для планшетов', THEME_PREFIX),
	]);

		$wp_customize->add_setting('header_top_line__short_label', [
		'default'           => Theme_Defaults::HEADER_TOP_LINE_SHORT_LABEL
	]);

	$wp_customize->add_control('header_top_line__short_label', [
		'type'    => 'text',
		'section' => 'header_top_line',
		'label'   => __('Строка описания для смартфонов', THEME_PREFIX),
	]);
});