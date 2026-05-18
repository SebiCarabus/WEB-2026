<?php
declare(strict_types=1);
define('SEP',DIRECTORY_SEPARATOR);
define('PDIR',dirname(__FILE__));

session_start();

require_once 'core/autoload.php';

$router = new Router();

$router->dispatch($_SERVER['REQUEST_URI'],strtolower($_SERVER['REQUEST_METHOD']));