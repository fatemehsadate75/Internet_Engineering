<?php
 if (!defined('_PS_VERSION_')) exit; function upgrade_module_2_3_9($object) { if( $object->registerHook('dashboardZoneOne') && $object->registerHook('dashboardData') ) return true; } 