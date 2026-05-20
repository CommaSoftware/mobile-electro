<?php

$review_video_id = get_post_meta(get_the_ID(), '_review_video_id', true);
$review_video_url = $review_video_id ? wp_get_attachment_url($review_video_id) : '';

$review_full_name = get_post_meta(get_the_ID(), '_review_full_name', true);
$review_position = get_post_meta(get_the_ID(), '_review_position', true);
$review_organization = get_post_meta(get_the_ID(), '_review_organization', true);
?>


<div class="review">
	<div class="review__content">
		<div class="review-content__stars">
			<span class="icon" data-type="star-filled"></span
			><span class="icon" data-type="star-filled"></span
			><span class="icon" data-type="star-filled"></span
			><span class="icon" data-type="star-filled"></span
			><span class="icon" data-type="star-filled"></span>
		</div>
		<?php if (!empty($review_video_url)) : ?>
			<div class="review-content__video">
				<video
					loading="lazy"
					class="review-content-video__player"
					controls
					src="<?php echo $review_video_url; ?>"
				></video>
			</div>
		<?php endif; ?>
		<?php if (!empty($review_full_name) || !empty($review_position)) : ?>
			<div class="review-content__name">
				<?php if (!empty($review_full_name)) : ?>
					<h4 class="heading is-size-h4"><?php echo $review_full_name ?></h4>
				<?php endif; ?>
				<?php if (!empty($review_position)) : ?>
					<span class="span is-size-xs"><?php echo $review_position ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if (!empty($review_organization)) : ?>
		<div class="review__footer">
			<div class="review-footer__company">
				<span class="icon is-color-blue" data-type="building"></span>
				<span class="span is-size-xs is-blue"><?php echo $review_organization; ?></span>
			</div>
		</div>
	<?php endif; ?>
</div>