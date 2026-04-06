<?php

add_action('customize_register', function(WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_setting('title_tagline__head_code',[
			'default'           => 'default-icon',
	]);
	$wp_customize->add_control(
		'title_tagline__head_code',
		array(
			'label' => 'HTML код для вставки в <HEAD>',
			'section' => 'title_tagline',
			'settings' => 'title_tagline__head_code',
			'type' => 'text',
		)
	);
});