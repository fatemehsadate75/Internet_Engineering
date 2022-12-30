<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_15($object) { $sql = "ALTER TABLE `" . _DB_PREFIX_ . "ranginesmspresta` 
			MODIFY COLUMN `customer`  varchar(5) NULL DEFAULT '' AFTER `id_ranginesmspresta`,
			MODIFY COLUMN `id_order`  varchar(10) NULL DEFAULT '' AFTER `customer`,
			MODIFY COLUMN `duration`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' AFTER `shop`;"; return Db::getInstance()->execute($sql); } 