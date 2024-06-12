<?php


use webDirectory\api\infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;
require_once __DIR__ . '/../src/vendor/autoload.php';
/* application boostrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';
Eloquent::init(__DIR__ . '/../src/conf/gift.db.conf.ini');