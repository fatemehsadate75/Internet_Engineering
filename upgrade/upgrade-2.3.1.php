<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_1($object) { Configuration::updateValue('RANGINE_SMS_OOSBUTTONTEXT', $object->l('Notify me when available')); Configuration::updateValue('RANGINE_SMS_OOSBUTTONPOSITION', ''); return true; } 