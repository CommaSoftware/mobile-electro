<?php
/**
 * Template For Content Sidebar On Single Page
 */
?>

<?php
	$theme_article_sidebar_show = get_theme_mod('article_sidebar__show', Theme_Defaults::ARTICLE_SIDEBAR_SHOW);
	$theme_article_sidebar_title = get_theme_mod('article_sidebar__title', Theme_Defaults::ARTICLE_SIDEBAR_TITLE);
	$theme_article_sidebar_description = get_theme_mod('article_sidebar__description', Theme_Defaults::ARTICLE_SIDEBAR_DESCRIPTION);
	$theme_article_sidebar_button1_link = get_theme_mod('article_sidebar__button1_link', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_LINK);
	$theme_article_sidebar_button1_name = get_theme_mod('article_sidebar__button1_name', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_NAME);
	$theme_article_sidebar_button1_icon = get_theme_mod('article_sidebar__button1_icon', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON1_ICON);
	$theme_article_sidebar_button2_link = get_theme_mod('article_sidebar__button2_link', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_LINK);
	$theme_article_sidebar_button2_name = get_theme_mod('article_sidebar__button2_name', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_NAME);
	$theme_article_sidebar_button2_icon = get_theme_mod('article_sidebar__button2_icon', Theme_Defaults::ARTICLE_SIDEBAR_BUTTON2_ICON);
?>

<?php if ($theme_article_sidebar_show == true) : ?>
	<div class="single-content-sidebar">
		<div class="single-content-sidebar__content">
			<?php if (!empty($theme_article_sidebar_title) || !empty($theme_article_sidebar_description)): ?>
				<div class="single-content-sidebar__header">
					<?php if (!empty($theme_article_sidebar_title)) : ?>
						<span class="heading is-size-h3"><?php echo $theme_article_sidebar_title; ?></span>
					<?php endif; ?>
					<?php if (!empty($theme_article_sidebar_description)) : ?>
						<span class="is-size-m"><?php echo $theme_article_sidebar_description; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if (!empty($theme_article_sidebar_button2_link) || !empty($theme_article_sidebar_button1_link)): ?>
				<div class="single-content-sidebar__actions">
					<?php if ($theme_article_sidebar_button2_link != ""): ?>
						<a
							href="<?php echo $theme_article_sidebar_button2_link; ?>"
							class="button is-size-l is-wide-full is-style-bordered"
							>
							<?php if ($theme_article_sidebar_button2_icon != ""): ?>
								<span class="icon" data-type="<?php echo $theme_article_sidebar_button2_icon; ?>"></span>
							<?php endif; ?>
							<?php echo $theme_article_sidebar_button2_name; ?>
						</a>
					<?php endif; ?>
					<?php if ($theme_article_sidebar_button1_link != ""): ?>
						<a
							href="<?php echo $theme_article_sidebar_button1_link; ?>"
							class="button is-size-l is-wide-full is-style-primary"
							>
							<?php if ($theme_article_sidebar_button1_icon != ""): ?>
								<span class="icon" data-type="<?php echo $theme_article_sidebar_button1_icon; ?>"></span>
							<?php endif; ?>
							<?php echo $theme_article_sidebar_button1_name; ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>