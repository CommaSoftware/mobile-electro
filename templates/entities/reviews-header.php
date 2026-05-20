<?php
	$theme_reviews_heading = get_theme_mod('reviews__heading', Theme_Defaults::REVIEWS_HEADING);
	$theme_reviews_description = get_theme_mod('reviews__description', Theme_Defaults::REVIEWS_DESCRIPTION);
	$theme_reviews_example = get_theme_mod('reviews__example', Theme_Defaults::REVIEWS_EXAMPLE);
	$theme_reviews_link_form = get_theme_mod('reviews__link_form', Theme_Defaults::REVIEWS_LINK_FORM);
	$theme_reviews_link_google = get_theme_mod('reviews__link_google', Theme_Defaults::REVIEWS_LINK_GOOGLE);
	$theme_reviews_link_yandex = get_theme_mod('reviews__link_yandex', Theme_Defaults::REVIEWS_LINK_YANDEX);
	$theme_reviews_name_other = get_theme_mod('reviews__name_other', Theme_Defaults::REVIEWS_NAME_OTHER);
	$theme_reviews_link_other = get_theme_mod('reviews__link_other', Theme_Defaults::REVIEWS_LINK_OTHER);
?>

<div class="section-header">
	<div class="content-wrapper">
		<?php get_template_part('templates/entities/breadcrumbs', null, [['name' => $theme_reviews_heading]]); ?>
		<div class="section-header__headings">
			<?php if (!empty($theme_reviews_heading)) : ?>
				<h1 class="heading"><?php echo $theme_reviews_heading; ?></h1>
			<?php endif; ?>
			<?php if (!empty($theme_reviews_description)) : ?>
				<span class="span"><?php echo $theme_reviews_description ?></span>
			<?php endif; ?>
		</div>
		<div class="section-header__actions">
			<?php if (!empty($theme_reviews_link_form)) : ?>
				<a
					href="<?php echo $theme_reviews_link_form ?>"
					class="button reviews__button-add-review is-size-l is-style-primary is-wide"
				>
					<span class="icon" data-type="star"></span>
					Оставить отзыв
				</a>
			<?php endif; ?>
			<?php if (!empty($theme_reviews_link_google) || !empty($theme_reviews_link_yandex) || (!empty($theme_reviews_name_other) && !empty($theme_reviews_link_other))) : ?>
				<span
					class="button reviews__button-label is-size-l is-style-transparent is-no-hover"
					>Открыть в...</span
				>
			<?php endif; ?>
			<?php if (!empty($theme_reviews_link_google)) : ?>
				<a
					href="<?php echo $theme_reviews_link_google; ?>"
					class="button reviews__button-service is-size-l is-style-bordered"
				>
					<span class="icon" data-type="google"></span>
					Google
				</a>
			<?php endif; ?>
			<?php if (!empty($theme_reviews_link_yandex)) : ?>
				<a
					href="<?php echo $theme_reviews_link_yandex; ?>"
					class="button reviews__button-service is-size-l is-style-bordered"
				>
					<span class="icon" data-type="yandex"></span>
					Яндекс
				</a>
			<?php endif; ?>
			<?php if (!empty($theme_reviews_name_other) && !empty($theme_reviews_link_other)) : ?>
				<a
					href="<?php echo $theme_reviews_link_other; ?>"
					class="button reviews__button-service is-size-l is-style-bordered"
				><?php echo $theme_reviews_name_other; ?></a>
			<?php endif; ?>
		</div>
		<div class="reviews-cover">
			<div class="reviews-cover__stars"></div>
			<?php if (!empty($theme_reviews_example)) : ?>
				<p class="reviews-cover__message"><?php echo $theme_reviews_example; ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>