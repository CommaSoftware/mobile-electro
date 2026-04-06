	<footer class="footer">
		<div class="footer__content">
			<div class="content-wrapper">
				<div class="footer-content__logo">
					<a href="<?php echo get_home_url();?>" class="logo-full">
						<?php if (get_theme_mod('footer_logo', Theme_Defaults::HEADER_LOGO) != ""): ?>
							<img src="<?php echo get_theme_mod('footer_logo', Theme_Defaults::HEADER_LOGO); ?>" alt="Логотип <?php bloginfo('name'); ?>">
						<?php else: ?>
							<span class="logo-full__name"
								>Мобильное эн<mark>е</mark>ргообеспечение</span
							>
						<?php endif; ?>
					</a>
				</div>
				<div class="footer-content__info">
					<div class="footer-content-info__location">
						<span class="span is-size-xs is-hilight">Юридический адрес</span>
						<span class="span is-size-s"
							>Московская область, город Чехов, Симферопольское шоссе, дом
							3А</span
						>
					</div>
					<div class="footer-content-info__contacts">
						<div class="footer-contacts-line">
							<div
								class="footer-contacts-line__icon button is-size-s is-style-transparent is-hilight is-aspect-ratio-1b1"
							>
								<span class="icon" data-type="phone"></span>
							</div>
							<a
								href="tel:+7 (968) 728-74-64"
								class="button is-size-s is-style-transparent"
								target="_blank"
								>+7 (968) 728-74-64
							</a>
							<a
								href="tel:+7 (495) 784-02-70"
								class="button is-size-s is-style-transparent"
								target="_blank"
								>+7 (495) 784-02-70
							</a>
						</div>
						<div class="footer-contacts-line">
							<div
								class="footer-contacts-line__icon button is-size-s is-style-transparent is-hilight is-aspect-ratio-1b1"
							>
								<span class="icon" data-type="email"></span>
							</div>
							<a
								href="mailto:snab.meo@mail.ru"
								target="_blank"
								class="button is-size-s is-style-transparent"
								>snab.meo@mail.ru
							</a>
						</div>
					</div>
					<div class="footer-content-info__socials">
						<a
							href="#!"
							target="_blank"
							class="button is-size-m is-style-bordered is-aspect-ratio-1b1"
							><span class="icon" data-type="telegramm"></span></a
						><a
							href="#!"
							target="_blank"
							class="button is-size-m is-style-bordered is-aspect-ratio-1b1"
							><span class="icon" data-type="max"></span
						></a>
					</div>
				</div>
				<div class="footer-content__nav">
					<ul>
						<li>
							<a href="404.html">Услуги</a>
							<ul>
								<li><a href="catalog.html">Аренда электрогенераторов</a></li>
								<li><a href="catalog.html">Покупка электрогенераторов</a></li>
								<li><a href="404.html">Обслуживание и ремонт</a></li>
								<li><a href="404.html">Калькуляторы</a></li>
							</ul>
						</li>
						<li>
							<a href="category-projects.html">Портфолио</a>
							<ul>
								<li><a href="blog-page.html">Блог</a></li>
								<li><a href="404.html">Словарь терминов</a></li>
								<li>
									<a href="category-projects.html">Реализованные проекты</a>
								</li>
								<li><a href="reviews-page.html">Отзывы</a></li>
							</ul>
						</li>
						<li>
							<a href="404.html">Компания</a>
							<ul>
								<li><a href="404.html">О нас</a></li>
								<li><a href="404.html">Карточка организации</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer__copyright">
			<div class="content-wrapper">
				<span class="footer-copyright__label span is-size-xs"
					>© 2026 «ООО Мобильное энерго-обеспечение»</span
				>
				<div class="footer-copyright__actions">
					<a
						href="404.html"
						class="button is-size-s is-style-transparent is-hilight"
						>Пользовательское соглашение</a
					><a
						href="404.html"
						class="button is-size-s is-style-transparent is-hilight"
						>Информация на сайте не является публичной офертой</a
					><a
						href="404.html"
						class="button is-size-s is-style-transparent is-hilight"
						>Licenses</a
					><a
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