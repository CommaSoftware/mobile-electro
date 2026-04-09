<?php 

$theme_footer_logo = get_theme_mod('footer__logo', Theme_Defaults::HEADER_LOGO);
$theme_copyright_name = get_theme_mod('footer__copyright_name', Theme_Defaults::FOOTER_COPYRIGHT_NAME);
$theme_privacy_link = get_theme_mod('footer__privacy_link', Theme_Defaults::FOOTER_PRIVACY_LINK);
$theme_offer_name = get_theme_mod('footer__offer_name', Theme_Defaults::FOOTER_OFFER_NAME);
$theme_offer_link = get_theme_mod('footer__offer_link', Theme_Defaults::FOOTER_OFFER_LINK);
$theme_licenses = get_theme_mod('footer__licenses', Theme_Defaults::FOOTER_LICENSES_LINK);

$theme_contacts_phone1 = get_theme_mod('contacts__phone1', Theme_Defaults::CONTACTS_PHONE1);
$theme_contacts_phone2 = get_theme_mod('contacts__phone2', Theme_Defaults::CONTACTS_PHONE2);
$theme_contacts_address = get_theme_mod('contacts__address', Theme_Defaults::CONTACTS_ADDRESS);
$theme_contacts_email = get_theme_mod('contacts__email', Theme_Defaults::CONTACTS_EMAIL);
$theme_contacts_tg_link = get_theme_mod('contacts__tg_link', Theme_Defaults::CONTACTS_TG_LINK);
$theme_contacts_max_link = get_theme_mod('contacts__max_link', Theme_Defaults::CONTACTS_MAX_LINK);

?>

<?php get_template_part("templates/entities/cookies") ?>

<footer class="footer">
	<div class="footer__content">
		<div class="content-wrapper">
			<div class="footer-content__logo">
				<a href="<?php echo get_home_url();?>" class="logo-full">
					<?php if ($theme_footer_logo != ""): ?>
						<img src="<?php echo $theme_footer_logo; ?>" alt="Логотип <?php bloginfo('name'); ?>">
					<?php else: ?>
						<span class="logo-full__name"
							>Мобильное эн<mark>е</mark>ргообеспечение</span
						>
					<?php endif; ?>
				</a>
			</div>
			<div class="footer-content__info">
				<?php if($theme_contacts_address != ''): ?>
					<div class="footer-content-info__location">
						<span class="span is-size-xs is-hilight">Юридический адрес</span>
						<span class="span is-size-s"
							><?php echo $theme_contacts_address; ?></span
						>
					</div>
				<?php endif; ?>
				<?php if($theme_contacts_phone1 != '' || $theme_contacts_phone2 != '' || $theme_contacts_email != ''): ?>
					<div class="footer-content-info__contacts">
						<?php if($theme_contacts_phone1 != '' || $theme_contacts_phone2 != ''): ?>
							<div class="footer-contacts-line">
								<div
									class="footer-contacts-line__icon button is-size-s is-style-transparent is-hilight is-aspect-ratio-1b1"
								>
									<span class="icon" data-type="phone"></span>
								</div>
								<?php if($theme_contacts_phone1 != ''): ?>
									<a
										href="tel:<?php echo $theme_contacts_phone1; ?>"
										class="button is-size-s is-style-transparent"
										target="_blank"
										><?php echo $theme_contacts_phone1; ?>
									</a>
								<?php endif; ?>
								<?php if($theme_contacts_phone2 != ''): ?>
									<a
										href="tel:<?php echo $theme_contacts_phone2; ?>"
										class="button is-size-s is-style-transparent"
										target="_blank"
										><?php echo $theme_contacts_phone2; ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if($theme_contacts_email != ''): ?>
							<div class="footer-contacts-line">
								<div
									class="footer-contacts-line__icon button is-size-s is-style-transparent is-hilight is-aspect-ratio-1b1"
								>
									<span class="icon" data-type="email"></span>
								</div>
								<a
									href="mailto:<?php echo $theme_contacts_email; ?>"
									target="_blank"
									class="button is-size-s is-style-transparent"
									><?php echo $theme_contacts_email; ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if($theme_contacts_tg_link != '' || $theme_contacts_max_link != ''): ?>
					<div class="footer-content-info__socials">
						<?php if ($theme_contacts_tg_link != ""): ?>
							<a
								href="<?php echo $theme_contacts_tg_link; ?>"
								title="Telegram"
								target="_blank"
								class="button is-size-m is-style-bordered is-aspect-ratio-1b1"
								><span class="icon" data-type="telegramm"></span
							></a>
						<?php endif; ?>
						<?php if ($theme_contacts_max_link != ""): ?>
							<a
								href="<?php echo $theme_contacts_max_link; ?>"
								title="MAX"
								target="_blank"
								class="button is-size-m is-style-bordered is-aspect-ratio-1b1"
								><span class="icon" data-type="max"></span
							></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-content__nav">
				<?php wp_nav_menu( [
					'theme_location'  => 'footer_menu',
					'menu'            => '',
					'container'       => false,
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 0,
					'walker'          => '',
				] ); ?>
			</div>
		</div>
	</div>
	<div class="footer__copyright">
		<div class="content-wrapper">
			<span class="footer-copyright__label span is-size-xs"
				>&copy; <?php echo date('Y'); ?><?php if ($theme_copyright_name != '') { echo ' «'.$theme_copyright_name.'»'; } ?>.</span
			>
			<div class="footer-copyright__actions">
				<?php if($theme_privacy_link != ''): ?>
					<a
						href="<?php echo $theme_privacy_link; ?>"
						class="button is-size-s is-style-transparent is-hilight"
					>Пользовательское соглашение</a>
				<?php endif; ?>
				<?php if($theme_offer_link != '' || $theme_offer_name != ''): ?>
					<a
						href="<?php echo $theme_offer_link; ?>"
						class="button is-size-s is-style-transparent is-hilight <?php if ($theme_offer_link == '') { echo 'is-no-hover'; } ?>"
						><?php echo $theme_offer_name; ?></a
					>
				<?php endif; ?>
				<?php if($theme_licenses != ''): ?>
					<a
						href="<?php echo $theme_licenses; ?>"
						class="button is-size-s is-style-transparent is-hilight"
					>Licenses</a>
				<?php endif; ?>

				<a
					href="https://commasoft.ru"
					target="_blank"
					class="button is-size-s is-style-transparent is-hilight"
					>Created by CommaSoftware</a
				>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>