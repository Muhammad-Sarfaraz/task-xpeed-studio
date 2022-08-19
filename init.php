<?php

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE_NAME', 'xpeed_studio_test');
define('ROOT_PATH', dirname(__DIR__) . '/');

if (!session_id()) session_start();
require_once 'class/database.php';
require_once 'class/order.php';
require_once 'library/validation.php';
require_once 'library/notify.php';
