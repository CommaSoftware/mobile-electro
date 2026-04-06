<?php

function styles_n_scripts() {
	// Main styles
	enqueue_versioned_style( 'style-main',                     '/style.css' );
	enqueue_versioned_style( 'style-cms-content',              '/assets/css/cms-content.css' );
	enqueue_versioned_style( 'style-fonts',                    '/assets/css/fonts.css' );
	enqueue_versioned_style( 'style-normalize',                '/assets/css/normalize.css' );
	enqueue_versioned_style( 'style-root',                     '/assets/css/root.css' );
	
	// Shared components
	enqueue_versioned_style( 'style-shared-button',            '/assets/css/shared/button.css' );
	enqueue_versioned_style( 'style-shared-characteristic',    '/assets/css/shared/characteristic.css' );
	enqueue_versioned_style( 'style-shared-checkbox',          '/assets/css/shared/checkbox.css' );
	enqueue_versioned_style( 'style-shared-heading',           '/assets/css/shared/heading.css' );
	enqueue_versioned_style( 'style-shared-icons',             '/assets/css/shared/icons.css' );
	enqueue_versioned_style( 'style-shared-input',             '/assets/css/shared/input.css' );
	enqueue_versioned_style( 'style-shared-logo',              '/assets/css/shared/logo.css' );
	enqueue_versioned_style( 'style-shared-radio',             '/assets/css/shared/radio.css' );
	enqueue_versioned_style( 'style-shared-range-input',       '/assets/css/shared/range-input.css' );
	enqueue_versioned_style( 'style-shared-select',            '/assets/css/shared/select.css' );
	enqueue_versioned_style( 'style-shared-span',              '/assets/css/shared/span.css' );
	
	// Entity components
	enqueue_versioned_style( 'style-entities-blog-card',       '/assets/css/entities/blog-card.css' );
	enqueue_versioned_style( 'style-entities-breadcrumbs',     '/assets/css/entities/breadcrumbs.css' );
	enqueue_versioned_style( 'style-entities-buttons-block',   '/assets/css/entities/buttons-block.css' );
	enqueue_versioned_style( 'style-entities-content-wrapper', '/assets/css/entities/content-wrapper.css' );
	enqueue_versioned_style( 'style-entities-cookie-overlay',  '/assets/css/entities/cookie-overlay.css' );
	enqueue_versioned_style( 'style-entities-float-img',       '/assets/css/entities/float-img.css' );
	enqueue_versioned_style( 'style-entities-heading-block',   '/assets/css/entities/heading-block.css' );
	enqueue_versioned_style( 'style-entities-pagination',      '/assets/css/entities/pagination.css' );
	enqueue_versioned_style( 'style-entities-popup',           '/assets/css/entities/popup.css' );
	enqueue_versioned_style( 'style-entities-product-card',    '/assets/css/entities/product-card.css' );
	enqueue_versioned_style( 'style-entities-review-card',     '/assets/css/entities/review-card.css' );
	enqueue_versioned_style( 'style-entities-section-header',  '/assets/css/entities/section-header.css' );
	enqueue_versioned_style( 'style-entities-view-block',      '/assets/css/entities/view-block.css' );
	
	// Widget components
	enqueue_versioned_style( 'style-widgets-advantages',       '/assets/css/widgets/advantages.css' );
	enqueue_versioned_style( 'style-widgets-blog',             '/assets/css/widgets/blog.css' );
	enqueue_versioned_style( 'style-widgets-cases',            '/assets/css/widgets/cases.css' );
	enqueue_versioned_style( 'style-widgets-catalog-preview',  '/assets/css/widgets/catalog-preview.css' );
	enqueue_versioned_style( 'style-widgets-catalog',          '/assets/css/widgets/catalog.css' );
	enqueue_versioned_style( 'style-widgets-footer',           '/assets/css/widgets/footer.css' );
	enqueue_versioned_style( 'style-widgets-header',           '/assets/css/widgets/header.css' );
	enqueue_versioned_style( 'style-widgets-hello-banner',     '/assets/css/widgets/hello-banner.css' );
	enqueue_versioned_style( 'style-widgets-map',              '/assets/css/widgets/map.css' );
	enqueue_versioned_style( 'style-widgets-not-found',        '/assets/css/widgets/not-found.css' );
	enqueue_versioned_style( 'style-widgets-product',          '/assets/css/widgets/product.css' );
	enqueue_versioned_style( 'style-widgets-reviews',          '/assets/css/widgets/reviews.css' );
	enqueue_versioned_style( 'style-widgets-single',           '/assets/css/widgets/single.css' );
	enqueue_versioned_style( 'style-widgets-target-banner',    '/assets/css/widgets/target-banner.css' );
	
	// Scripts
	enqueue_versioned_script( 'script-clipboard',              '/assets/js/clipboard.js', array(), true );
	enqueue_versioned_script( 'script-cookie',                 '/assets/js/cookie.js', array(), true );
	enqueue_versioned_script( 'script-float-img-win',          '/assets/js/float-img-win.js', array(), true );
	enqueue_versioned_script( 'script-header',                 '/assets/js/header.js', array(), true );
	enqueue_versioned_script( 'script-map',                    '/assets/js/map.js', array(), true );
	enqueue_versioned_script( 'script-popup',                  '/assets/js/popup.js', array(), true );
	enqueue_versioned_script( 'script-product-slider',         '/assets/js/product-slider.js', array(), true );
	enqueue_versioned_script( 'script-range-input',            '/assets/js/range-input.js', array(), true );
	enqueue_versioned_script( 'script-smooth-scroll',          '/assets/js/smooth-scroll.js', array(), true );
	enqueue_versioned_script( 'script-target-banner',          '/assets/js/target-banner.js', array(), true );

}
add_action( 'wp_enqueue_scripts', 'styles_n_scripts' );

	add_action( 'customize_preview_init', 'mytheme_customize_live_preview' );
	function mytheme_customize_live_preview() {
			wp_enqueue_script(
					'mytheme-customizer-preview',           // Уникальный идентификатор скрипта
					get_template_directory_uri() . '/js/customizer-preview.js', // Путь к файлу
					array( 'customize-preview' ),           // Зависимости (без jQuery!)
					'1.0.0',                                // Версия
					true                                    // Загружать в футере
			);
	}

// Dynamic versioning of files with styles
function enqueue_versioned_script( $handle, $src = false, $deps = array(), $in_footer = false ) {
	wp_enqueue_script( $handle, get_stylesheet_directory_uri() . $src, $deps, filemtime( get_stylesheet_directory() . $src ), $in_footer );
}
function enqueue_versioned_style( $handle, $src = false, $deps = array(), $media = 'all' ) {
	wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $src, $deps = array(), filemtime( get_stylesheet_directory() . $src ), $media );
} 