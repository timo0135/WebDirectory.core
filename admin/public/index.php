<?php
declare(strict_types=1);


use webDirectory\admin\infrastructure\Eloquent;

require_once __DIR__ . '/../src/vendor/autoload.php';

/* application boostrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';
Eloquent::init(__DIR__ . '/../src/conf/gift.db.conf.ini');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define('addAcount', 1);
$app->run();

