<?php
$terms = get_terms(array(
	'taxonomy' => 'industries',
	'orderby' => 'name',
	'order' => 'ASC',
	'hide_empty' => false, // показывать даже пустые термины
)); ?> 
<?php 
	$theme_cases_show = get_theme_mod("cases__show", Theme_Defaults::CASES_SHOW);
	$theme_cases_heading = get_theme_mod("cases__heading", Theme_Defaults::CASES_HEADING);
	$theme_cases_description = get_theme_mod("cases__description", Theme_Defaults::CASES_DESCRIPTION);
	$theme_cases_link = get_theme_mod('cases__link', Theme_Defaults::CASES_LINK);
	$theme_cases_thumbnail = get_theme_mod('cases__thumbnail', Theme_Defaults::CASES_THUMBNAIL);
?>

<?php if ($theme_cases_show) : ?>
	<section id="cases" class="cases">
		<div class="content-wrapper">
			<?php if ($theme_cases_description != '' || $theme_cases_heading != '') : ?>
				<div class="heading-block">
					<?php if ($theme_cases_heading != '') : ?>
						<h2 class="heading is-size-h2"><?php echo $theme_cases_heading; ?></h2>
					<?php endif; ?>
					<?php if ($theme_cases_description != '') : ?>
						<span class="span is-size-m"><?php echo $theme_cases_description; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="cases-block<?php if (empty($theme_cases_thumbnail)) { echo ' no-cover'; } ?>">
			<?php if (!empty($terms) && !is_wp_error($terms)) : ?>
				<?php if (!empty($theme_cases_thumbnail)) : ?>
					<img
						class="cases-block__cover"
						src="<?php echo $theme_cases_thumbnail; ?>"
						alt="Кейсы и портфолио"
					/>
				<?php endif; ?>
				<?php foreach ($terms as $term) : ?>
					<a href="<?php echo $theme_cases_link; ?>" class="cases-block__item">
						<h3 class="cases-block-item__heading heading is-size-h4"><?php echo $term->name; ?></h3>
						<p class="cases-block-item__description span is-hilight"><?php echo $term->description; ?></p>
						<div class="cases-block-item__action">
							<div class="button is-size-l is-style-bordered is-rounded">
								Проекты<span class="icon" data-type="arrow-right-md"></span>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>