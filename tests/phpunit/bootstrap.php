<?php

$loader = require __DIR__ . "/../../vendor/autoload.php";
$loader->addPsr4('Monolog\\', __DIR__ . '/../../vendor/monolog/monolog/tests/Monolog');

date_default_timezone_set('UTC');
