<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_2_0($object) { $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'ranginesmspresta_sms` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `text` text COLLATE utf8_persian_ci NOT NULL,
			  `weight` int(3) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=' . _MYSQL_ENGINE_ . ' AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;'; return ( Configuration::updateValue($object->prefix . 'LICENSE', 'YTozOntzOjQ6ImNvZGUiO3M6MDoiIjtzOjEwOiJ1cGRhdGV0aW1lIjtzOjA6IiI7czoxMDoiZXhwaXJldGltZSI7czowOiIiO30=') && Db::getInstance()->execute($sql) && $object->registerHook('displayAdminOrderLeft') ); } 