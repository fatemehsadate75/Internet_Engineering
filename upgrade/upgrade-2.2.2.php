<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_2_2($object) { if(file_exists(_PS_MODULE_DIR_.$object->name.'/ajax.php')) @unlink(_PS_MODULE_DIR_.$object->name.'/ajax.php'); return ( $object->installModuleTab('rangineAdminAjax', 'Rangine Ajax Class', -1,$object->name) ); } 