<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_10($object) { Configuration::updateValue('RANGINE_SMS_TOPMENU', 1); Configuration::updateValue('RANGINE_SMS_LOWCREDITALERT', 1); Configuration::updateValue('RANGINE_SMS_PANELADDRESS', 'https://sms.rangine.ir'); return true; } 