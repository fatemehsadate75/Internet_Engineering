<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_7($object) { Configuration::updateValue('RANGINE_SMS_GATEWAYNAME', '1'); Configuration::updateValue('RANGINE_SMS_VERIFICATONTEXT' , 'کد تأیید شما: {code}~{shop_name}'); Configuration::updateValue('RANGINE_SMS_VERIFICATONTEXTTYPE' , 'sample'); return true; } 