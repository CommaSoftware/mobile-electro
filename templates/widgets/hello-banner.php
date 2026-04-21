<?php

	$theme_main_banner_heading = get_theme_mod('main_banner__heading', Theme_Defaults::MAIN_BANNER_HEADING);
	$theme_main_banner_description = get_theme_mod('main_banner__description', Theme_Defaults::MAIN_BANNER_DESCRIPTION);
	$theme_main_banner_thumbnail = get_theme_mod('main_banner__thumbnail', Theme_Defaults::MAIN_BANNER_THUMBNAIL);
	$theme_main_banner_button1_link = get_theme_mod('main_banner__button1_link', Theme_Defaults::MAIN_BANNER_BUTTON1_LINK);
	$theme_main_banner_button1_name = get_theme_mod('main_banner__button1_name', Theme_Defaults::MAIN_BANNER_BUTTON1_NAME);
	$theme_main_banner_button1_icon = get_theme_mod('main_banner__button1_icon', Theme_Defaults::MAIN_BANNER_BUTTON1_ICON);
	$theme_main_banner_button2_link = get_theme_mod('main_banner__button2_link', Theme_Defaults::MAIN_BANNER_BUTTON2_LINK);
	$theme_main_banner_button2_name = get_theme_mod('main_banner__button2_name', Theme_Defaults::MAIN_BANNER_BUTTON2_NAME);
	$theme_main_banner_button2_icon = get_theme_mod('main_banner__button2_icon', Theme_Defaults::MAIN_BANNER_BUTTON2_ICON);

?>

<section id="hello-banner" class="hello-banner">
	<div class="content-wrapper">
		<div class="hello-banner__description">
			<?php if ($theme_main_banner_heading != ""): ?>
				<h2 class="heading is-size-h1 is-white"><?php echo $theme_main_banner_heading; ?></h2>
			<?php endif; ?>
			<?php if ($theme_main_banner_description != ""): ?>
				<p class="span is-size-s"><?php echo $theme_main_banner_description; ?></p>
			<?php endif; ?>
			<?php if ($theme_main_banner_button1_link != "" || $theme_main_banner_button2_link != ""): ?>
				<div class="hello-banner-description__actions">
					<?php if ($theme_main_banner_button1_link != ""): ?>
						<a
							href="<?php echo $theme_main_banner_button1_link; ?>"
							class="button is-style-primary is-size-l"
							>
							<?php if ($theme_main_banner_button1_icon != ""): ?>
								<span class="icon" data-type="<?php echo $theme_main_banner_button1_icon; ?>"></span>
							<?php endif; ?>
							<?php echo $theme_main_banner_button1_name; ?>
						</a>
					<?php endif; ?>
					<?php if ($theme_main_banner_button2_link != ""): ?>
						<a
							href="<?php echo $theme_main_banner_button2_link; ?>"
							class="button is-style-transparent is-size-l"
							>
							<?php if ($theme_main_banner_button2_icon != ""): ?>
								<span class="icon" data-type="<?php echo $theme_main_banner_button2_icon; ?>"></span>
							<?php endif; ?>
							<?php echo $theme_main_banner_button2_name; ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ($theme_main_banner_thumbnail != '') : ?>
		<img
			class="hello-banner__cover"
			src="<?php echo $theme_main_banner_thumbnail; ?>"
			alt="Обложка баннера"
		/>
		<?php endif; ?>
	</div>
</section>