<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_2_4($object) { Configuration::updateValue('RANGINE_SMS_OOSSUMADMIN', '1'); Configuration::updateValue('RANGINE_SMS_USERINVOICE', '/index.php?controller=pdf-invoice&id_order={order_id}'); Configuration::updateValue('RANGINE_SMS_GUESTINVOICE', '/guest-tracking?order_reference={order_reference}&email={guest_email}'); Configuration::updateValue('RANGINE_SMS_SHORTINVOICEKEY', 'rsl'); Configuration::updateValue('RANGINE_SMS_mobileinputs', '[]'); $object->registerHook('moduleRoutes'); return true; } 