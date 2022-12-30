<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_14($object) { Configuration::updateValue('RANGINE_SMS_kfadeliverytimetheme', '{w} {d} {mm} {y}'); return true; } 