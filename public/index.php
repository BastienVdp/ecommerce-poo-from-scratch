<?php
ini_set('display_errors', 1);

require '../vendor/autoload.php';

$config = require '../app/config.php';

$app = new App\Core\Application(
	dirname(__DIR__),
	$config
);

require '../app/routes.php';

$app->run();