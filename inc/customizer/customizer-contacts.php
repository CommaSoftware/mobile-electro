<?php
add_action('customize_register', function($wp_customize) {

	$wp_customize->add_section('contacts', [
		'title'    => 'Контакты',
		'priority' => 10,
	]);

	// Schedule
	$wp_customize->add_setting('contacts_schedule', [
		'default'           => Theme_Defaults::CONTACTS_SCHEDULE,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts_schedule', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Расписание', THEME_PREFIX),
	]);

	// Address
	$wp_customize->add_setting('contacts_address', [
		'default'           => Theme_Defaults::CONTACTS_ADDRESS,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts_address', [
		'type'    => 'textarea',
		'section' => 'contacts',
		'label'   => __('Юридический адрес', THEME_PREFIX),
	]);

	// Phones
	$wp_customize->add_setting('contacts_phone1', [
		'default'           => Theme_Defaults::CONTACTS_PHONE1,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts_phone1', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Основной телефон', THEME_PREFIX),
	]);

	$wp_customize->add_setting('contacts_phone2', [
		'default'           => Theme_Defaults::CONTACTS_PHONE2,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts_phone2', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Дополнительный телефон', THEME_PREFIX),
	]);

	// Email
	$wp_customize->add_setting('contacts_email', [
		'default'           => Theme_Defaults::CONTACTS_EMAIL
	]);
	$wp_customize->add_control('contacts_email', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('E-mail', THEME_PREFIX),
	]);
	
	// TG Link
	$wp_customize->add_setting('contacts_tg_link', [
		'default'           => Theme_Defaults::CONTACTS_TG_LINK
	]);
	$wp_customize->add_control('contacts_tg_link', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Ссылка на Telegram', THEME_PREFIX),
	]);

	
	// MAX Link
	$wp_customize->add_setting('contacts_max_link', [
		'default'           => Theme_Defaults::CONTACTS_MAX_LINK,
		'sanitize_callback' => 'sanitize_text_field'
	]);
	$wp_customize->add_control('contacts_max_link', [
		'type'    => 'text',
		'section' => 'contacts',
		'label'   => __('Ссылка на MAX', THEME_PREFIX),
	]);
});


// Временно добавьте в functions.php
function mobilelectro_reset_corrupted_setting() {
    // Удаляем испорченное значение
    remove_theme_mod('contacts_tg_link');
    
    // Устанавливаем корректное значение по умолчанию
    set_theme_mod('contacts_tg_link', '#');
    
    // Выводим уведомление
    echo '<div class="notice notice-warning"><p>Настройка button1_url была сброшена</p></div>';
}
add_action('admin_notices', 'mobilelectro_reset_corrupted_setting');