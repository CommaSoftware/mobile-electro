<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php wp_title('–', true, 'right');?> <?php bloginfo('name'); ?></title>

	<!-- Meta for SEO -->
	<?php if(is_front_page()) { ?>
		<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
	<?php } elseif(is_single()) { ?>
		<meta name="description" content="<?php echo get_post()->post_excerpt; ?>">
	<?php } ?>

	<!-- Meta for social network -->
	<meta property="og:title" content="<?php wp_title('–', true, 'right');?> <?php bloginfo('name'); ?>" />
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot-short.png" />

	<?php echo get_theme_mod('title_tagline__head_code', ''); ?>

	<?php wp_head(); ?>
</head>
<body>

	<?php
		$theme_contacts_phone1 = get_theme_mod('contacts__phone1', Theme_Defaults::CONTACTS_PHONE1);
		$theme_contacts_phone2 = get_theme_mod('contacts__phone2', Theme_Defaults::CONTACTS_PHONE2);
		$theme_contacts_schedule = get_theme_mod('contacts__schedule', Theme_Defaults::CONTACTS_SCHEDULE);
		$theme_contacts_email = get_theme_mod('contacts__email', Theme_Defaults::CONTACTS_EMAIL);
		$theme_contacts_tg_link = get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK);
		$theme_contacts_vk_link = get_theme_mod('contacts__vk_link', Theme_Defaults::CONTACTS_VK_LINK);
		$theme_contacts_max_link = get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK);
		
		$theme_header_top_line_show = get_theme_mod('header_top_line__show', Theme_Defaults::HEADER_TOP_LINE_SHOW);
		$theme_header_top_line_full_label = get_theme_mod('header_top_line__full_label', Theme_Defaults::HEADER_TOP_LINE_FULL_LABEL);
		$theme_header_top_line_short_label = get_theme_mod('header_top_line__short_label', Theme_Defaults::HEADER_TOP_LINE_SHORT_LABEL);

		$theme_header_logo = get_theme_mod('header__logo', Theme_Defaults::HEADER_LOGO);
		$theme_header_button1_link = get_theme_mod('header__button1_link', Theme_Defaults::HEADER_BUTTON1_LINK);
		$theme_header_button1_name = get_theme_mod('header__button1_name', Theme_Defaults::HEADER_BUTTON1_NAME);
		$theme_header_button1_icon = get_theme_mod('header__button1_icon', Theme_Defaults::HEADER_BUTTON1_ICON);
		$theme_header_button2_link = get_theme_mod('header__button2_link', Theme_Defaults::HEADER_BUTTON2_LINK);
		$theme_header_button2_name = get_theme_mod('header__button2_name', Theme_Defaults::HEADER_BUTTON2_NAME);
		$theme_header_button2_icon = get_theme_mod('header__button2_icon', Theme_Defaults::HEADER_BUTTON2_ICON);
	?>

	<header class="header">
		<?php if(!empty($theme_contacts_phone2) && $theme_header_top_line_show) : ?>
			<a href="tel:<?php echo $theme_contacts_phone2; ?>" class="header-top-line">
				<div class="content-wrapper">
					<?php if (!empty($theme_header_top_line_full_label)) : ?>
						<span class="header-top-line__full-label span is-hilight"><?php echo $theme_header_top_line_full_label; ?></span>
					<?php endif; ?>
					<?php if (!empty($theme_header_top_line_short_label)) : ?>
						<span class="header-top-line__short-label span is-hilight"><?php echo $theme_header_top_line_short_label; ?></span>
					<?php endif; ?>
					<div class="button is-style-transparent is-size-m is-no-hover">
						<span class="icon is-color-hilight" data-type="phone"></span>
						<?php echo $theme_contacts_phone2; ?>
					</div>
				</div>
			</a>
		<?php endif; ?>
		<div class="content-wrapper header__content-block">
			<div class="header__contacts">
				<div class="header-contacts__line">
					<?php if ($theme_contacts_phone1 != ""): ?>
						<a
							href="tel:<?php echo $theme_contacts_phone1; ?>"
							class="button is-style-transparent is-size-m"
							><?php echo $theme_contacts_phone1; ?></a
						>
					<?php endif; ?>
					<?php if ($theme_contacts_phone2 != ""): ?>
						<a
							href="tel:<?php echo $theme_contacts_phone2; ?>"
							class="button is-style-transparent is-size-m"
							><?php echo $theme_contacts_phone2; ?></a
						>
					<?php endif; ?>
				</div>
				<?php if ($theme_contacts_schedule != ""): ?>
					<span class="span is-size-xs is-hilight"><?php echo $theme_contacts_schedule; ?></span>
				<?php endif; ?>
			</div>
			<div class="header__logo">
				<a href="<? echo get_home_url(); ?>" class="logo-full">
					<?php if ($theme_header_logo != ""): ?>
						<img src="<?php echo $theme_header_logo; ?>" alt="Логотип <?php bloginfo('name'); ?>">
					<?php else: ?>
						<span class="logo-full__name"
							>Мобильное эн<mark>е</mark>ргообеспечение</span
						>
						<span class="logo-full__description"
							>Аренда · продажа · обслуживание генераторов</span
						>
					<?php endif; ?>
				</a>
			</div>
			<div class="header__actions">
				<div
					class="header__menu-button button is-aspect-ratio-1b1 is-style-bordered"
				>
					<span class="icon" data-type="hamburger"></span>
				</div>
				<?php if ($theme_header_button2_link != ""): ?>
					<a
						href="<?php echo $theme_header_button2_link; ?>"
						class="button is-style-bordered header__catalog-button"
						>
						<?php if ($theme_header_button2_icon != ""): ?>
							<span class="icon" data-type="<?php echo $theme_header_button2_icon; ?>"></span>
						<?php endif; ?>
						<?php echo $theme_header_button2_name; ?>
					</a>
				<?php endif; ?>
				<?php if ($theme_header_button1_link != ""): ?>
					<a
						href="<?php echo $theme_header_button1_link; ?>"
						class="button is-style-accent is-wide header__target-button"
						>
						<?php if ($theme_header_button1_icon != ""): ?>
							<span class="icon" data-type="<?php echo $theme_header_button1_icon; ?>"></span>
						<?php endif; ?>
						<?php echo $theme_header_button1_name; ?>
					</a>
				<?php endif; ?>
			</div>
			<div class="header__social">
				<?php if ($theme_contacts_tg_link != ""): ?>
					<a
						href="<?php echo $theme_contacts_tg_link; ?>"
						title="Telegram"
						target="_blank"
						class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
						><span class="icon" data-type="telegramm"></span
					></a>
				<?php endif; ?>
				<?php if ($theme_contacts_vk_link != ""): ?>
					<a
						href="<?php echo $theme_contacts_vk_link; ?>"
						title="VK"
						target="_blank"
						class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
						><span class="icon" data-type="vk"></span
					></a>
				<?php endif; ?>
				<?php if ($theme_contacts_max_link != ""): ?>
					<a
						href="<?php echo $theme_contacts_max_link; ?>"
						title="MAX"
						target="_blank"
						class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
						><span class="icon" data-type="max"></span
					></a>
				<?php endif; ?>
				<?php if ($theme_contacts_email != ""): ?>
				<a
					href="mailto:<?php echo $theme_contacts_email; ?>"
					class="button is-style-transparent is-size-m"
					><?php echo $theme_contacts_email; ?></a
				>
				<?php endif; ?>
			</div>
			<nav class="header__nav">
				<?php wp_nav_menu( [
					'theme_location'  => 'header_menu',
					'menu'            => '',
					'container'       => false,
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 0,
					'walker'          => '',
				] ); ?>
			</nav>
		</div>
	</header>