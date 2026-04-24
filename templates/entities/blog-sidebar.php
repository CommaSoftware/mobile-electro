<?php
	$theme_blog_name = get_bloginfo('name');

	$theme_contacts_tg_link = get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK);
	$theme_contacts_max_link = get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK);

	$theme_blog_show_sidebar = get_theme_mod("blog__show_sidebar", Theme_Defaults::BLOG_SHOW_SIDEBAR);
	$theme_blog_heading = get_theme_mod("blog__heading", Theme_Defaults::BLOG_HEADING);
	$theme_blog_description = get_theme_mod("blog__description", Theme_Defaults::BLOG_DESCRIPTION);
	$theme_blog_thumbnail = get_theme_mod("blog__thumbnail", Theme_Defaults::BLOG_THUMBNAIL);
?>

<?php if($theme_blog_show_sidebar) : ?>
	<div class="blog-sidebar" style="grid-row: 1 / calc(<?php echo get_blog_posts_per_page();?> / 2 + 2)">
		<div class="blog-author">
			<span class="blog-author__subheading span is-size-xs is-hilight"
				>Автор</span
			>
			<div class="blog-author__header">
				<?php if($theme_blog_thumbnail != '') : ?>
					<img
						src="<?php echo $theme_blog_thumbnail; ?>"
						class="blog-author-header__avatar"
						alt="<?php echo $theme_blog_name; ?>"
					/>
				<?php endif; ?>
				<div class="blog-author-header__name">
					<h3 class="heading is-size-h5"><?php echo $theme_blog_name; ?></h3>
					<span class="span is-size-xs is-hilight">Блог компании</span>
				</div>
			</div>
			<?php if($theme_blog_description != '') : ?>
				<div class="cms-content">
					<p><?php echo $theme_blog_description; ?></p>
				</div>
			<?php endif; ?>
			<?php if($theme_contacts_tg_link != '' || $theme_contacts_max_link != '') : ?>
				<div class="blog-author__actions">
					<?php if ($theme_contacts_tg_link != ""): ?>
						<a
							href="<?php echo $theme_contacts_tg_link; ?>"
							title="Telegram"
							target="_blank"
							class="button is-size-s is-style-bordered is-aspect-ratio-1b1"
							><span class="icon" data-type="telegramm"></span
						></a>
					<?php endif; ?>
					<?php if ($theme_contacts_max_link != ""): ?>
						<a
							href="<?php echo $theme_contacts_max_link; ?>"
							title="MAX"
							target="_blank"
							class="button is-size-s is-style-bordered is-aspect-ratio-1b1"
							><span class="icon" data-type="max"></span
						></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>