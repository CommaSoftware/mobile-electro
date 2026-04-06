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

	<?php echo get_theme_mod('title_tagline__head_code', ''); ?>

	<?php wp_head(); ?>
</head>
<body>
	<header class="header">
		<div class="content-wrapper header__content-block">
			<div class="header__contacts">
				<div class="header-contacts__line">
					<?php if (get_theme_mod('contacts__phone1', Theme_Defaults::CONTACTS_PHONE1) != ""): ?>
						<a
							href="tel:<?php echo get_theme_mod('contacts__phone1', Theme_Defaults::CONTACTS_PHONE1); ?>"
							class="button is-style-transparent is-size-m"
							><?php echo get_theme_mod('contacts__phone1', Theme_Defaults::CONTACTS_PHONE1); ?></a
						>
					<?php endif; ?>
					<?php if (get_theme_mod('contacts__phone2', Theme_Defaults::CONTACTS_PHONE2) != ""): ?>
						<a
							href="tel:<?php echo get_theme_mod('contacts__phone2', Theme_Defaults::CONTACTS_PHONE2); ?>"
							class="button is-style-transparent is-size-m"
							><?php echo get_theme_mod('contacts__phone2', Theme_Defaults::CONTACTS_PHONE2); ?></a
						>
					<?php endif; ?>
				</div>
				<?php if (get_theme_mod('contacts__schedule', Theme_Defaults::CONTACTS_SCHEDULE) != ""): ?>
					<span class="span is-size-xs is-hilight"><?php echo get_theme_mod('contacts__schedule', Theme_Defaults::CONTACTS_SCHEDULE); ?></span>
				<?php endif; ?>
			</div>
			<div class="header__logo">
				<a href="<? echo get_home_url(); ?>" class="logo-full">
					<?php if (get_theme_mod('header__logo', Theme_Defaults::HEADER_LOGO) != ""): ?>
						<img src="<?php echo get_theme_mod('header__logo', Theme_Defaults::HEADER_LOGO); ?>" alt="Логотип <?php bloginfo('name'); ?>">
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
				<?php if (get_theme_mod('header__button2_link', Theme_Defaults::HEADER_BUTTON2_LINK) != ""): ?>
					<a
						href="<?php echo get_theme_mod('header__button2_link', '/catalog'); ?>"
						class="button is-style-bordered header__catalog-button"
						>
						<?php if (get_theme_mod('header__button2_icon', Theme_Defaults::HEADER_BUTTON2_ICON) != ""): ?>
							<span class="icon" data-type="<?php echo get_theme_mod('header__button2_icon',Theme_Defaults::HEADER_BUTTON2_ICON); ?>"></span>
						<?php endif; ?>
						<?php echo get_theme_mod('header__button2_name', Theme_Defaults::HEADER_BUTTON2_NAME); ?>
					</a>
				<?php endif; ?>
				<?php if (get_theme_mod('header__button1_link', Theme_Defaults::HEADER_BUTTON1_LINK) != ""): ?>
					<a
						href="<?php echo get_theme_mod('header__button1_link', Theme_Defaults::HEADER_BUTTON1_LINK); ?>"
						class="button is-style-accent is-wide header__target-button"
						>
						<?php if (get_theme_mod('header__button1_icon', Theme_Defaults::HEADER_BUTTON1_ICON) != ""): ?>
							<span class="icon" data-type="<?php echo get_theme_mod('header__button1_icon', Theme_Defaults::HEADER_BUTTON1_ICON); ?>"></span>
						<?php endif; ?>
						<?php echo get_theme_mod('header__button1_name', Theme_Defaults::HEADER_BUTTON2_NAME); ?>
					</a>
				<?php endif; ?>
			</div>
			<div class="header__social">
				<?php if (get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK) != ""): ?>
				<a
					href="<?php echo get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK); ?>"
					title="Telegram"
					target="_blank"
					class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
					><span class="icon" data-type="telegramm"></span
				></a>
				<?php endif; ?>
				<?php if (get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK) != ""): ?>
				<a
					href="<?php echo get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK); ?>"
					title="MAX"
					target="_blank"
					class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
					><span class="icon" data-type="max"></span
				></a>
				<?php endif; ?>
				<?php if (get_theme_mod('contacts__email', Theme_Defaults::CONTACTS_EMAIL) != ""): ?>
				<a
					href="mailto:<?php echo get_theme_mod('contacts__email', Theme_Defaults::CONTACTS_EMAIL); ?>"
					class="button is-style-transparent is-size-m"
					><?php echo get_theme_mod('contacts__email', Theme_Defaults::CONTACTS_EMAIL); ?></a
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