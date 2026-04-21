<?php
$advantages_items_count = 4;
$advantages_items = [];

for ($i = 1; $i <= $advantages_items_count; $i++) {
    $advantages_items[] = [
        'heading'     => get_theme_mod("advantages__item{$i}_heading", constant("Theme_Defaults::ADVANTAGES_ITEM{$i}_HEADING") ?? ''),
        'description' => get_theme_mod("advantages__item{$i}_description", constant("Theme_Defaults::ADVANTAGES_ITEM{$i}_DESCRIPTION") ?? ''),
        'icon'        => get_theme_mod("advantages__item{$i}_icon", constant("Theme_Defaults::ADVANTAGES_ITEM{$i}_ICON") ?? ''),
    ];
}
?>

<section id="advantages" class="advantages">
	<div class="content-wrapper">
		<?php foreach ($advantages_items as $item) : ?>
			<?php if (!empty($item['heading']) || !empty($item['description'])) : ?>
				<div class="advantages__item">
					<?php if (!empty($item['icon'])) : ?>
						<div class="advantages-item__cover">
							<span class="icon is-color-hilight" data-type="<?php echo esc_attr($item['icon']); ?>"></span>
						</div>
					<?php endif; ?>
					
					<div class="advantages-item__description">
						<?php if (!empty($item['heading'])) : ?>
							<h3 class="heading is-size-h4"><?php echo esc_html($item['heading']); ?></h3>
						<?php endif; ?>
						
						<?php if (!empty($item['description'])) : ?>
							<p class="span is-size-s is-hilight"><?php echo esc_html($item['description']); ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</section>