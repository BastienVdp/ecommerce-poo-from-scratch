<?php

use App\Core\Application;

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

Application::get('/', [App\Controllers\HomeController::class, 'index']);
Application::get('/profile', [App\Controllers\HomeController::class, 'profile']);

Application::get('/login', [App\Controllers\AuthController::class, 'login']);
Application::post('/login', [App\Controllers\AuthController::class, 'login']);

Application::get('/register', [App\Controllers\AuthController::class, 'register']);
Application::post('/register', [App\Controllers\AuthController::class, 'register']);

$app->run();