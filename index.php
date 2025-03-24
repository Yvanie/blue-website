
<?php

use Dotenv\Dotenv;
use BleuWebsite\Core\Main;

require 'vendor/autoload.php';

$path = str_replace('\\', '/', dirname(__DIR__) . '/blue-website/');
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
if ($_ENV['ENVIRONNEMENT'] === 'PRODUCTION') {
  error_reporting(0); // Disable error reporting in production
}
define('ROOT', $path);
define('URL', $_ENV['DOMAINE']);

$app = new Main;

$app->start();




