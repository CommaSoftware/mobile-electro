<?php
/**
 * Template For Content Sharing Panel On Single Page
 */
?>

<?php 
	if (!get_post_status(get_the_ID())) {
			return;
	}

	$title = get_the_title();
	$permalink = get_permalink();
?>

<!-- НАДО ТЕСТИТЬ!!! -->

<div class="single-content-sharing">
	<div class="single-content-sharing__content">
		<div class="button is-aspect-ratio-1b1" onclick="copyWithPopup('<?php echo $permalink; ?>')">
			<span class="icon" data-type="link-horizontal"></span>
		</div>
		<a href="https://t.me/share/url?url=<?php echo $permalink ?>&text=<?php echo $title ?>" target="_blank" class="button is-aspect-ratio-1b1">
			<span class="icon" data-type="telegramm"></span>
		</a>
		<a href="https://vk.com/share.php?url=<?php echo $permalink ?>&title=<?php echo $title ?>" target="_blank" class="button is-aspect-ratio-1b1">
			<span class="icon" data-type="vk"></span>
		</a>
	</div>
</div>