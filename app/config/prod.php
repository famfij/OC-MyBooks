<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '8889',
    'dbname'   => 'mybooks',
    'user'     => 'mybooks_user',
    'password' => 'secret',
);