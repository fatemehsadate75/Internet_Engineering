<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_3($object) { Configuration::updateValue('RANGINE_SMS_SHORTPRODUCTKEY', 'rsl'); return true; } 