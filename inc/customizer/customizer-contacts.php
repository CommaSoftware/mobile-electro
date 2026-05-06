<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('contacts', [
		'title'    => 'Контакты',
		'priority' => 10,
	]);

	// Schedule
	$wp_customize->add_setting('contacts__schedule', [
		'default'           => Theme_Defaults::CONTACTS_SCHEDULE,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__schedule', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Расписание', THEME_PREFIX),
	]);

	// Address
	$wp_customize->add_setting('contacts__address', [
		'default'           => Theme_Defaults::CONTACTS_ADDRESS,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__address', [
		'type'    => 'textarea',
		'section' => 'contacts',
		'label'   => __('Юридический адрес', THEME_PREFIX),
	]);

	// Phones
	$wp_customize->add_setting('contacts__phone1', [
		'default'           => Theme_Defaults::CONTACTS_PHONE1,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__phone1', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Мобильный телефон', THEME_PREFIX),
	]);

	$wp_customize->add_setting('contacts__phone2', [
		'default'           => Theme_Defaults::CONTACTS_PHONE2,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__phone2', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Стационарный телефон', THEME_PREFIX),
	]);

	// Email
	$wp_customize->add_setting('contacts__email', [
		'default'           => Theme_Defaults::CONTACTS_EMAIL
	]);
	$wp_customize->add_control('contacts__email', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('E-mail', THEME_PREFIX),
	]);
	
	// TG Link
	$wp_customize->add_setting('contacts__tg_link', [
		'default'           => Theme_Defaults::CONTACTS_TG_LINK
	]);
	$wp_customize->add_control('contacts__tg_link', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Ссылка на Telegram', THEME_PREFIX),
	]);

	
	// MAX Link
	$wp_customize->add_setting('contacts__max_link', [
		'default'           => Theme_Defaults::CONTACTS_MAX_LINK,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__max_link', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Ссылка на MAX', THEME_PREFIX),
	]);

	// VK Link
	$wp_customize->add_setting('contacts__vk_link', [
		'default'           => Theme_Defaults::CONTACTS_VK_LINK,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts__vk_link', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Ссылка на MAX', THEME_PREFIX),
	]);
});