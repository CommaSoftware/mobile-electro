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
		const FOOTER_PRIVACY_LINK = 'privacy-policy';
		const FOOTER_OFFER_NAME = 'Не является публичной офертой';
		const FOOTER_OFFER_LINK = '/offer-info';
		const FOOTER_LICENSES_LINK = '/licenses';
		
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