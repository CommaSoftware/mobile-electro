<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title><?php wp_title('–', true, 'right');?> <?php bloginfo('name'); ?></title>

		<!-- Meta for SEO -->
		<?php if(is_front_page()) { ?>
			<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
		<?php } elseif(is_single()) { ?>
			<meta name="description" content="<?php echo get_post()->post_excerpt; ?>">
		<?php } ?>

		<?php wp_head(); ?>
  </head>
  <body>
    <header class="header">
      <div class="content-wrapper header__content-block">
        <div class="header__contacts">
          <div class="header-contacts__line">
            <a
              href="tel:+7 (495) 784-02-70"
              class="button is-style-transparent is-size-m"
              >+7 (495) 784-02-70</a
            >
            <a
              href="tel:+7 (968) 728-74-64"
              class="button is-style-transparent is-size-m"
              >+7 (968) 728-74-64</a
            >
          </div>
          <span class="span is-size-xs is-hilight">8:00-19:00 МСК</span>
        </div>
        <div class="header__logo">
          <a href="index.html" class="logo-full">
            <span class="logo-full__name"
              >Мобильное эн<mark>е</mark>ргообеспечение</span
            >
            <span class="logo-full__description"
              >Аренда · продажа · обслуживание генераторов</span
            >
          </a>
        </div>
        <div class="header__actions">
          <div
            class="header__menu-button button is-aspect-ratio-1b1 is-style-bordered"
          >
            <span class="icon" data-type="hamburger"></span>
          </div>
          <a
            href="catalog.html"
            class="button is-style-bordered header__catalog-button"
          >
            <span class="icon" data-type="list-unordered"></span>
            Каталог
          </a>
          <a
            href="#buy"
            class="button is-style-accent is-wide header__target-button"
          >
            <span class="icon" data-type="truck"></span>
            Заказать звонок
          </a>
        </div>
        <div class="header__social">
          <a
            href="#!"
            target="_blank"
            class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
            ><span class="icon" data-type="telegramm"></span
          ></a>
          <a
            href="#!"
            target="_blank"
            class="button is-style-secondary is-size-m is-aspect-ratio-1b1"
            ><span class="icon" data-type="max"></span
          ></a>
          <a
            href="mailto:snab.meo@mail.ru"
            class="button is-style-transparent is-size-m"
            >snab.meo@mail.ru</a
          >
        </div>
        <nav class="header__nav">
          <ul>
            <li>
              <a href="404.html">Услуги</a>
              <ul>
                <li><a href="catalog.html">Аренда электрогенераторов</a></li>
                <li><a href="catalog.html">Покупка электрогенераторов</a></li>
                <li><a href="404.html">Обслуживание и ремонт</a></li>
              </ul>
            </li>
            <li><a href="404.html">Калькуляторы</a></li>
            <li><a href="blog-page.html">Блог</a></li>
            <li><a href="404.html">О компании</a></li>
          </ul>
        </nav>
      </div>
    </header>