<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('reviews', [
		'title'    => 'Раздел «Отзывы»',
		'description' => 'Общие настройки раздела',
		'priority' => 10,
		'panel' => 'sections_panel'
	]);

	// Link
	$wp_customize->add_setting('reviews__link', [
		'default'           => Theme_Defaults::REVIEWS_LINK
	]);

	$wp_customize->add_control('reviews__link', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Ссылка на раздел', THEME_PREFIX),
		'description' => __('Укажите ссылку на страницу Отзывов', THEME_PREFIX),
	]);

	// Show preview in front
	$wp_customize->add_setting( 'reviews__show_in_front', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'default'           => Theme_Defaults::REVIEWS_SHOW_IN_FRONT,
		'sanitize_callback' => 'sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'reviews__show_in_front', array(
		'label'       => __( 'Показывать блок отзывов на главной', THEME_PREFIX ),
		'section'     => 'reviews',
		'type'        => 'checkbox',
	) );

	// Heading
	$wp_customize->add_setting('reviews__heading', [
		'default'           => Theme_Defaults::REVIEWS_HEADING
	]);

	$wp_customize->add_control('reviews__heading', [
		'type'    => 'text',
		'section' => 'reviews',
		'label'   => __('Заголовок', THEME_PREFIX),
	]);

	// Description
	$wp_customize->add_setting('reviews__description', [
		'default'           => Theme_Defaults::REVIEWS_DESCRIPTION
	]);

	$wp_customize->add_control('reviews__description', [
		'type'    => 'text',
		'section' => 'reviews',
		'label'   => __('Описание', THEME_PREFIX),
	]);

	// Review example
	$wp_customize->add_setting('reviews__example', [
		'default'           => Theme_Defaults::REVIEWS_EXAMPLE
	]);

	$wp_customize->add_control('reviews__example', [
		'type'    => 'textarea',
		'section' => 'reviews',
		'label'   => __('Текст отзыва', THEME_PREFIX),
		'description'   => __('Пример отзыва в баннере', THEME_PREFIX),
	]);

	// Link form
	$wp_customize->add_setting('reviews__link_form', [
		'default'           => Theme_Defaults::REVIEWS_LINK_FORM
	]);

	$wp_customize->add_control('reviews__link_form', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Форма обратной связи', THEME_PREFIX),
		'description' => __('Укажите ссылку для кнопки "Оставить отзыв"', THEME_PREFIX),
	]);

	// Link Google
	$wp_customize->add_setting('reviews__link_google', [
		'default'           => Theme_Defaults::REVIEWS_LINK_GOOGLE
	]);

	$wp_customize->add_control('reviews__link_google', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Ссылка на отзывы в Google', THEME_PREFIX),
	]);

	// Link Yandex
	$wp_customize->add_setting('reviews__link_yandex', [
		'default'           => Theme_Defaults::REVIEWS_LINK_YANDEX
	]);

	$wp_customize->add_control('reviews__link_yandex', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Ссылка на отзывы в Yandex', THEME_PREFIX),
	]);

	// Link other
	$wp_customize->add_setting('reviews__link_other', [
		'default'           => Theme_Defaults::REVIEWS_LINK_OTHER
	]);

	$wp_customize->add_control('reviews__link_other', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Ссылка на другой сервис отзывов', THEME_PREFIX),
	]);

	// Name other
	$wp_customize->add_setting('reviews__name_other', [
		'default'           => Theme_Defaults::REVIEWS_NAME_OTHER
	]);

	$wp_customize->add_control('reviews__name_other', [
		'type'        => 'text',
		'section'     => 'reviews',
		'label'       => __('Название другого сервиса отзывов', THEME_PREFIX),
	]);
});