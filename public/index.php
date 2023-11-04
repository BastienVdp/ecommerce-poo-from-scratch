<?php

use App\Core\Application;

ini_set('display_errors', 1);

require '../vendor/autoload.php';

$app = new Application(
	dirname(__DIR__),
	[
		"database" => [
			'host' => 'localhost',
			'port' => '3306',
			'name' => 'mvc_projects',
			'username' => 'root',
			'password' => '',
		],
		"session" => [
			'flash_key' => 'flash_key',
		]
	]
);

require '../app/routes.php';

$app->run();