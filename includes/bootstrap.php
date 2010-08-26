<?php

define('PROJECT_DIR', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
define('LOG_DIR', PROJECT_DIR . DIRECTORY_SEPARATOR . 'logs');
define('CONFIG_DIR', PROJECT_DIR . DIRECTORY_SEPARATOR . 'configs');

set_include_path(PROJECT_DIR . DIRECTORY_SEPARATOR . 'library' . PATH_SEPARATOR . get_include_path());
set_include_path(PROJECT_DIR . DIRECTORY_SEPARATOR . 'includes' . PATH_SEPARATOR . get_include_path());

require_once('functions.php');

?>