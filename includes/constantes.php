<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 0.8.0-alpha
 * FormDin Version: 4.2.5-alpha
 * 
 * System educ created in: 2018-06-27 11:06:14
 */
$ambiente  = ServidorConfig::getInstancia()->getConfigParam('ambiente');
if( $ambiente == 'produção' || $ambiente == 'producao' ) {
    $ambiente = null;
}

define('J25'    , 'Joomla 2.5.8');
define('J39'    , 'Joomla 3.9.13');

define('J25_DB', 'joomlainternet');
define('J25_DBID','j16_');
define('J39_DB', 'portal');
define('J39_DBID','j36_');


define('SYSTEM_NAME'    , 'Migração do Joomla 2.5 para 3.9');
define('SYSTEM_NAME_SUB', $ambiente);
define('SYSTEM_ACRONYM' , 'migraj');
define('SYSTEM_VERSION' , '2.1.0');
define('APLICATIVO'     , SYSTEM_ACRONYM);

define('FORMDIN_VERSION_MIN_VERSION', '4.7.8');

if ( !defined('DS') ){ define('DS'   , DIRECTORY_SEPARATOR); }

?>