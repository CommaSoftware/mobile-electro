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
		
		const HEADER_LOGO = false; 
		const HEADER_BUTTON1_ICON = 'truck'; 
		const HEADER_BUTTON1_NAME = 'Заказать звонок';
		const HEADER_BUTTON1_LINK = '#buy';
		const HEADER_BUTTON2_ICON = 'list-unordered'; 
		const HEADER_BUTTON2_NAME = 'Каталог';
		const HEADER_BUTTON2_LINK = '/catalog';

		const FOOTER_LOGO = false;
		const FOOTER_COPYRIGHT_NAME = 'ООО Мобильное Энергообеспечение';
		const FOOTER_PRIVACY_LINK = 'privacy-policy';
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