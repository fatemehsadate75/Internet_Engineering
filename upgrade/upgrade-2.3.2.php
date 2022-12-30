<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_2($object) { Configuration::updateValue('RANGINE_SMS_OOSBUTTONWRAPPER', ''); return true; } 