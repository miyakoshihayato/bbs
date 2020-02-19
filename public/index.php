<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');

use bbs\Routing;

$routing = new Routing();

$routing->execute();