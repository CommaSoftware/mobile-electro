<?php
/**
 * Template Name: Страница «Отзывы»
 * Template post type: page
 */
?>

<?php get_header(); ?>

<section id="reviews" class="reviews">
	<?php get_template_part('templates/entities/reviews-header') ?>
	<?php get_template_part('templates/entities/reviews-content') ?>
</section>

<?php get_template_part("templates/widgets/catalog-view"); ?>
<?php get_template_part("templates/widgets/target-banner"); ?>


<?php get_footer(); ?>
