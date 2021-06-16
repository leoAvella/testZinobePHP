<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$cap = new Capsule;

$cap->addConnection([
    'driver'     => 'mysql',
    //'host'       => '192.168.0.7', //mi ip
    'host'       => 'localhost', //localhost para revision
    'database'   => 'zinobe',
    'username'   => 'zinobe',
    'password'   => 'zinobe',
    'charset'    => 'utf8',
    'collation'  => 'utf8_unicode_ci',
    'prefix'     => '',
]);

$cap->bootEloquent();


?>
