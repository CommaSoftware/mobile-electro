<?php
function register_post_types(){
	register_post_type( 'product', [
		'label'  => null,
		'labels' => [
			'name'               => 'Генераторы', // the main name for the record type
			'singular_name'      => 'Генератор', // name for one record of this type
			'add_new'            => 'Добавить геренатор', // to add a new entry
			'add_new_item'       => 'Добавление геренатора', // the title of the newly created entry in the admin panel
			'edit_item'          => 'Редактирование геренатора', // to edit the record type
			'new_item'           => 'Новый геренатор', // text of the new entry
			'view_item'          => 'Просмотр геренатора', // to view a record of this type
			'search_items'       => 'Искать геренатор', // to search for these types of records
			'not_found'          => 'Не найдено', // if nothing was found in the search result
			'not_found_in_trash' => 'Не найдено в корзине', // if it was not found in the trash
			'menu_name'          => 'Геренаторы', // menu name
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // whether to show it in the admin menu
		'show_in_admin_bar'   => true, // depends on show_in_menu
		'show_in_rest'        => false, // add to the REST API. C WP 4.7
		'rest_base'           => 'product', // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => ['title', 'editor'], // 'title','editor','author','excerpt','trackbacks','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ 'industries' ],
		'has_archive'         => true,
		'rewrite'             => array( 'slug'=>'catalog/product'),
		'feeds'               => false,
		'query_var'           => true,
		'menu_icon'           => 'dashicons-lightbulb',
	] );

		register_post_type( 'review', [
		'label'  => null,
		'labels' => [
			'name'               => 'Отзывы', // the main name for the record type
			'singular_name'      => 'Отзыв', // name for one record of this type
			'add_new'            => 'Добавить отзыв', // to add a new entry
			'add_new_item'       => 'Добавление отзыва', // the title of the newly created entry in the admin panel
			'edit_item'          => 'Редактирование озыва', // to edit the record type
			'new_item'           => 'Новый геренатор', // text of the new entry
			'view_item'          => 'Просмотр отзыва', // to view a record of this type
			'search_items'       => 'Искать отзыв', // to search for these types of records
			'not_found'          => 'Не найдено', // if nothing was found in the search result
			'not_found_in_trash' => 'Не найдено в корзине', // if it was not found in the trash
			'menu_name'          => 'Отзывы', // menu name
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // whether to show it in the admin menu
		'show_in_admin_bar'   => true, // depends on show_in_menu
		'show_in_rest'        => false, // add to the REST API. C WP 4.7
		'rest_base'           => 'review', // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => ['title'], // 'title','editor','author','excerpt','trackbacks','comments','revisions','page-attributes','post-formats'
		'has_archive'         => true,
		'rewrite'             => array( 'slug'=>'/reviews'),
		'feeds'               => false,
		'query_var'           => true,
		'menu_icon'           => 'dashicons-star-filled',
	] );
}
add_action( 'init', 'register_post_types' );