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

Application::get('/', [App\Controllers\HomeController::class, 'index']);
Application::get('/profile', [App\Controllers\ProfileController::class, 'index']);
Application::get('/products', [App\Controllers\ProductController::class, 'index']);
Application::get('/products/{id}', [App\Controllers\ProductController::class, 'show']);
Application::get('/products/{id}/edit', [App\Controllers\ProductController::class, 'edit']);

Application::get('/login', [App\Controllers\AuthController::class, 'login']);
Application::post('/login', [App\Controllers\AuthController::class, 'login']);

Application::get('/register', [App\Controllers\AuthController::class, 'register']);
Application::post('/register', [App\Controllers\AuthController::class, 'register']);

Application::get('/logout', function() {
	Application::$app->unsetUser();
	Application::$app->response->redirect('/');
});

$app->run();