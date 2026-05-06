<?php
/**
 * Theme configuration file
 */

// Theme prefix (used for functions, hooks, settings)
define('THEME_PREFIX', 'mobilelectro');

class Theme_Defaults {
		
		const CONTACTS_PHONE1 = '+7 (968) 728-74-64';
		const CONTACTS_PHONE2 = '+7 (495) 784-02-70';
		const CONTACTS_EMAIL = 'snab.meo@mail.ru';
		const CONTACTS_SCHEDULE = '8:00-19:00 МСК';
		const CONTACTS_ADDRESS = 'Московская область, город Чехов, Симферопольское шоссе, дом 3А';
		const CONTACTS_TG_LINK = '#!';
		const CONTACTS_MAX_LINK = '#!';
		const CONTACTS_VK_LINK = '#!';
		
		const HEADER_LOGO = false; 
		const HEADER_BUTTON1_ICON = 'truck'; 
		const HEADER_BUTTON1_NAME = 'Заказать звонок';
		const HEADER_BUTTON1_LINK = '#buy';
		const HEADER_BUTTON2_ICON = 'list-unordered'; 
		const HEADER_BUTTON2_NAME = 'Каталог';
		const HEADER_BUTTON2_LINK = '/catalog';

		const HEADER_TOP_LINE_SHOW = true;
		const HEADER_TOP_LINE_FULL_LABEL = 'Есть вопросы? Звоните!';
		const HEADER_TOP_LINE_SHORT_LABEL = 'Звоните:';

		const FOOTER_LOGO = false;
		const FOOTER_COPYRIGHT_NAME = 'ООО Мобильное Энергообеспечение';
		const FOOTER_PRIVACY_LINK = '/privacy-policy';
		const FOOTER_OFFER_NAME = 'Не является публичной офертой';
		const FOOTER_OFFER_LINK = '/offer-info';
		const FOOTER_LICENSES_LINK = '/licenses';

		const ARTICLE_SIDEBAR_SHOW = true;
		const ARTICLE_SIDEBAR_TITLE = 'Нужен электрогенератор?';
		const ARTICLE_SIDEBAR_DESCRIPTION = 'Это к нам!';
		const ARTICLE_SIDEBAR_BUTTON1_ICON = '';
		const ARTICLE_SIDEBAR_BUTTON1_NAME = 'Каталог генераторов';
		const ARTICLE_SIDEBAR_BUTTON1_LINK = '/catalog';
		const ARTICLE_SIDEBAR_BUTTON2_ICON = '';
		const ARTICLE_SIDEBAR_BUTTON2_NAME = 'Задать вопрос';
		const ARTICLE_SIDEBAR_BUTTON2_LINK = '/contact-us';

		const ARTICLE_SHARING_SHOW_LINK = true;
		const ARTICLE_SHARING_SHOW_TG = true;
		const ARTICLE_SHARING_SHOW_VK = true;

		const MAIN_BANNER_HEADING = 'Аренда и продажа дизельных электростанций в Москве';
		const MAIN_BANNER_DESCRIPTION = 'Доставим, установим и проведём обслуживание электрогенератора';
		const MAIN_BANNER_THUMBNAIL = '/wp-content/themes/mobile-electro/assets/images/examples/generator-1.png';
		const MAIN_BANNER_BUTTON1_ICON = 'truck'; 
		const MAIN_BANNER_BUTTON1_NAME = 'Заказать звонок';
		const MAIN_BANNER_BUTTON1_LINK = '#buy';
		const MAIN_BANNER_BUTTON2_ICON = ''; 
		const MAIN_BANNER_BUTTON2_NAME = 'Выбрать подходящий генератор';
		const MAIN_BANNER_BUTTON2_LINK = '/catalog';

		const TARGET_BANNER_HEADING = 'Заказать звонок';
		const TARGET_BANNER_DESCRIPTION = 'Оставьте контакты, и мы свяжемся </br>с Вами в течение часа';
		const TARGET_BANNER_THUMBNAIL = '/wp-content/themes/mobile-electro/assets/images/examples/generator-1.png';
		const TARGET_FORM_SHORTCODE = '';
		const TARGET_BANNER_MAX_SLIDER_ITEMS = 10;
		const TARGET_BANNER_FORM_HTML = '<div class="input-wrapper">
        [text* your-name class:input placeholder "Имя"]
    </div>
    
    <div class="input-wrapper">
        [tel* your-phone class:input placeholder "Телефон"]
    </div>
    
    <div class="radiobox is-style-switcher">
        [radio target-type use_label_element default:1 "Хочу арендовать"]
        [radio target-type use_label_element "Хочу купить"]
    </div>
    
    <div class="textarea-wrapper">
        [textarea your-message class:input placeholder "Комментарий"]
    </div>

<div class="button-wrapper">
    [submit class:button class:is-style-accent class:is-wide-full "Отправить"]
</div>

<label class="checkbox">
[acceptance acceptance-427 class:checkbox_confirmation] <span class="span is-size-s is-hilight">Я даю согласие на обработку персональных данных и принимаю <a href="/privacy-policy/">условия политики обработки персональных данных</a></span>[/acceptance]
</label>';

		const ADVANTAGES_SHOW = true;
		const ADVANTAGES_ITEM1_HEADING = 'Поможем выбрать';
		const ADVANTAGES_ITEM1_DESCRIPTION = 'Поможем с выбором генератора и забронируем его онлайн или по телефону.';
		const ADVANTAGES_ITEM1_ICON = 'phone'; 
		const ADVANTAGES_ITEM2_HEADING = 'Доставим в удобное время';
		const ADVANTAGES_ITEM2_DESCRIPTION = ' Мы доставим генератор в удобное для вас время и место в любую точку западной России.';
		const ADVANTAGES_ITEM2_ICON = 'truck'; 
		const ADVANTAGES_ITEM3_HEADING = 'Установим';
		const ADVANTAGES_ITEM3_DESCRIPTION = 'Наши специалисты установят и подключат генератор, проверив его работоспособность.';
		const ADVANTAGES_ITEM3_ICON = 'checkbox-checked';
		const ADVANTAGES_ITEM4_HEADING = 'ТО и гарантийный ремонт';
		const ADVANTAGES_ITEM4_DESCRIPTION = 'Проведём техническое обслуживание и поможем, если возникнут проблемы.';
		const ADVANTAGES_ITEM4_ICON = 'cog'; 

		const MAP_SHOW = true;
		const MAP_HEADING = 'Работаем с клиентами по всей европейской России!';
		const MAP_DESCRIPTION = '<mark class="map-block__heading-mark">3521 объект</mark> использует нашу энергию прямо сейчас';
		const MAP_BUTTON_ICON = 'truck'; 
		const MAP_BUTTON_NAME = 'Заказать';
		const MAP_BUTTON_LINK = '#buy';

		const CASES_SHOW = true;
		const CASES_HEADING = 'Аренда и продажа дизельных электростанций в Москве';
		const CASES_DESCRIPTION = '';
		const CASES_THUMBNAIL = '/wp-content/themes/mobile-electro/assets/images/examples/example-case.png';
		const CASES_LINK = '/category/cases/';

		const BLOG_HEADING = 'Блог';
		const BLOG_LINK = '/blog';
		const BLOG_ANSWER_TO_EMPTY = 'Раздел пуст, загляните позже';
		const BLOG_SHOW_SIDEBAR = true;
		const BLOG_THUMBNAIL = '/wp-content/themes/mobile-electro/assets/images/avatar.jpg';
		const BLOG_DESCRIPTION = 'Добро пожаловать в блог, где мы мы делимся опытом, накопленнным за более 10 лет работы с ДГУ. Разбираем ошибки, сравниваем модели, публикуем чек-листы и пошаговые инструкции – всё для того, чтобы вы получили надёжное энергоснабжение без переплат и сюрпризов. ';

		const BLOG_VIEW_SHOW_ON_FRONT = true;
		const BLOG_VIEW_HEADING = 'Полезно знать';
		const BLOG_VIEW_DESCRIPTION = '';

		const CATALOG_LINK = '/catalog';

		const PRODUCT_VIEW_SHOW_ON_FRONT = true;
		const PRODUCT_VIEW_HEADING = 'Популярные модели';
		const PRODUCT_VIEW_DESCRIPTION = '';

		const PRODUCT_BUY_LINK = '#buy';
		const PRODUCT_DELIVERY_NAME = 'Доставка по западной России';
		const PRODUCT_DELIVERY_LINK = '/delivery';
		const PRODUCT_RENT_INSTRUCTION = '<ol>
	<li>Оформите заказ на сайте или позвоните на горячую линию;</li>
	<li>Получение реквизитов, подписание документов и оплата;</li>
	<li>
		Самовывоз или доставка оборудования лицу, имеющему
		доверенность и паспорт.
	</li>
</ol>
<hr />
<p>Для офорлмения услуги понадобятся:</p>
<p>Для юридических лиц:</p>
<ul>
	<li>Реквизиты для оформления договора и счета</li>
	<li>Оплата счета</li>
	<li>
		Печать, доверенность и документ, подтверждающий личность
		сотрудника, указанного в доверенности для получения
	</li>
</ul>
<p>Для физических лиц:</p>
<ul>
	<li>
		Паспорт гражданина РФ или иной документ, удостоверяющий
		личность
	</li>
	<li>Номер мобильного телефона, адрес электронной почты</li>
</ul>';
		const PRODUCT_RATE_LIST = '<div class="product__rate-list">
<details class="product-rate-list-item">
	<summary>
		<div
			class="button is-no-hover is-style-secondary is-size-l"
		>
			<span
				class="icon is-color-accent"
				data-type="leaf"
			></span>
			Контроль качества топлива
		</div>
	</summary>
	<div class="product-rate-list-item__content">
		<p>
			Контроль качества и уровня топлива, для обеспечения
			стабильности работы
		</p>
	</div>
</details>
<details class="product-rate-list-item">
	<summary>
		<div
			class="button is-no-hover is-style-secondary is-size-l"
		>
			<span
				class="icon is-color-accent"
				data-type="arrow-reload"
			></span>
			Подменный ДГУ
		</div>
	</summary>
	<div class="product-rate-list-item__content">
		<p>
			Оперативная замена генератора, без простоя при
			неисправности
		</p>
	</div>
</details>
<details class="product-rate-list-item">
	<summary>
		<div
			class="button is-no-hover is-style-secondary is-size-l"
		>
			<span
				class="icon is-color-accent"
				data-type="chat-conversation"
			></span>
			Техподдержка
		</div>
	</summary>
	<div class="product-rate-list-item__content">
		<p>Круглосуточная консультация и помощь специалистов</p>
	</div>
</details>
<details class="product-rate-list-item">
	<summary>
		<div
			class="button is-no-hover is-style-secondary is-size-l"
		>
			<span class="icon is-color-accent" data-type="cog"></span>
			Сервис ТО
		</div>
	</summary>
	<div class="product-rate-list-item__content">
		<p>Регулярное обслуживание оборужования</p>
	</div>
</details>
</div>';
		
		/**
		 * Get all default values as an array
		 *
		 * @return array Array of all default settings
		 */
		public static function get_all_defaults() {
				$reflection = new ReflectionClass(__CLASS__);
				$constants = $reflection->getConstants();
				
				$defaults = [];
				foreach ($constants as $key => $value) {
						$setting_name = strtolower(str_replace('_', '-', $key));
						$defaults[$setting_name] = $value;
				}
				
				return $defaults;
		}
		
		/**
		 * Get the default value for a specific setting
		 *
		 * @param string $key The configuration key
		 * @param mixed $default Default value if the constant is not found
		 * @return mixed
		 */
		public static function get($key, $default = null) {
				$constant_name = strtoupper(str_replace('-', '_', $key));
				
				if (defined("self::$constant_name")) {
						return constant("self::$constant_name");
				}
				
				return $default;
		}
		
		/**
		 * Get settings for a specific group
		 *
		 * @param string $group The settings group (GENERAL, COLORS, TYPOGRAPHY, etc.)
		 * @return array
		 */
		public static function get_group($group) {
				$prefix = strtoupper($group) . '_';
				$constants = (new ReflectionClass(__CLASS__))->getConstants();
				
				$group_defaults = [];
				foreach ($constants as $key => $value) {
						if (strpos($key, $prefix) === 0) {
								$setting_name = strtolower(str_replace('_', '-', $key));
								$group_defaults[$setting_name] = $value;
						}
				}
				
				return $group_defaults;
		}
}