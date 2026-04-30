<?php
		$theme_contacts_tg_link = get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK);
		$theme_contacts_max_link = get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK);

	$theme_target_banner_shortcode = get_theme_mod("target_banner__shortcode", Theme_Defaults::TARGET_FORM_SHORTCODE);
	$theme_target_banner_heading = get_theme_mod("target_banner__heading", Theme_Defaults::TARGET_BANNER_HEADING);
	$theme_target_banner_description = get_theme_mod("target_banner__description", Theme_Defaults::TARGET_BANNER_DESCRIPTION);
	$theme_target_banner_thumbnail = get_theme_mod("target_banner__thumbnail", Theme_Defaults::TARGET_BANNER_THUMBNAIL);

	$theme_target_banner_slider_items = array();
	for ( $i = 1; $i <= Theme_Defaults::TARGET_BANNER_MAX_SLIDER_ITEMS; $i++ ) {
		$slider_item_heading = get_theme_mod( "target_banner__slider_item{$i}__heading", '' );
		$slider_item_description = get_theme_mod( "target_banner__slider_item{$i}__description", '' );
	
		if ( !empty($slider_item_heading) || !empty($slider_item_description) ) {
			$theme_target_banner_slider_items[] = array(
				'heading' => $slider_item_heading,
				'description' => $slider_item_description,
			);
		}
	}
?>

<section id="buy" class="target-banner has-margin-top">
	<div class="target-banner__content-wrapper content-wrapper">
		<div class="target-banner-content">
			<div class="target-banner__form-block">
				<div class="target-banner-form">
					<?php if ($theme_target_banner_description != '' || $theme_target_banner_heading != '') : ?>
						<div class="target-banner-form__header heading-block">
							<?php if ($theme_target_banner_heading != '') : ?>
								<h2 class="heading is-size-h2"><?php echo $theme_target_banner_heading; ?></h2>
							<?php endif; ?>
							<?php if ($theme_target_banner_description != '') : ?>
								<span class="span is-size-m"><?php echo $theme_target_banner_description; ?></span>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="target-banner-form__fields">
						<?php if($theme_target_banner_shortcode) {echo do_shortcode($theme_target_banner_shortcode);} ?>
					</div>
				</div>
				<span class="span is-size-xs is-white">или</span>
				<div class="target-banner-contacts">
					<?php if ($theme_contacts_tg_link != ""): ?>
						<a
							href="<?php echo $theme_contacts_tg_link; ?>"
							target="_blank"
							class="button is-style-primary is-rounded"
							>Написать нам в TG<span
								class="icon"
								data-type="telegramm-filled"
							></span
						></a>
					<?php endif; ?>
					<?php if ($theme_contacts_max_link != ""): ?>
						<a
							href="<?php echo $theme_contacts_max_link; ?>"
							target="_blank"
							class="button is-style-primary is-rounded"
							>MAX<span class="icon" data-type="max-filled"></span
						></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="target-banner__cover">
				<?php if ($theme_target_banner_thumbnail) : ?>
					<img
						src="<?php echo $theme_target_banner_thumbnail ?>"
						class="target-banner-cover__image"
						alt="Широкий выбор генераторов"
					/>
				<?php endif; ?>
				<div id="target_banner_slider" class="target-banner-cover__slider">
					<?php foreach ( $theme_target_banner_slider_items as $slider_item ) : ?>
						<div class="target-banner-cover-slider__item">
							<?php if (!empty($slider_item['heading'])) : ?>
								<h4 class="heading is-size-h4 is-white"><?php echo $slider_item['heading']; ?></h4>
							<?php endif; ?>
							<?php if (!empty($slider_item['description'])) : ?>
								<p class="span is-size-s is-white"><?php echo $slider_item['description']; ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>