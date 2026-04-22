<?php

function register_taxonomy_industries() {
	$labels = array(
	"name" => __('Индустрии', 'industries'),
	"singular_name" => __('Индустрия', 'industries'),
	"all_items" => __('Все индустрии', 'all_industries'),
	"edit_item" => __('Изменить индустрию', 'edit_industry'),
	"view_item" => __('Посмотреть индустрию', 'view_industry'),
	"update_item" => __('Обновить индустрию', 'update_industry'),
	"add_new_item" => __('Добавить', 'add'),
	"new_item_name" => __('Новая', 'new'),
	);
	$args = array(
	"label" => __( 'Индустрии', 'years'),
	"labels" => $labels,
	"public" => true,
	"hierarchical" => false,
	"show_ui" => true,
	"show_in_menu" => true,
	"show_in_nav_menus" => true,
	"query_var" => true,
	"rewrite" => false,
	"show_admin_column" => true,
	"rest_base" => "",
	"show_in_quick_edit" => true,
	'show_in_rest' => true,
	);
	register_taxonomy("industries", array("post", "product"), $args);
}
add_action( 'init', 'register_taxonomy_industries' );

?>