<?php

define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));

define('PATH', dirname(__FILE__) . DS);
define('APP', PATH . 'application' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

require SYS . 'start' . EXT;