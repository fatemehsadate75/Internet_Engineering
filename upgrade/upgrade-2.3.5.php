<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_5($object) { return $object->registerHook('displayCustomerIdentityForm'); } 