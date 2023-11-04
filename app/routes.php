<?php 

use App\Core\Application;

Application::get('/', [App\Controllers\HomeController::class, 'index']);

Application::get('/profile', [App\Controllers\ProfileController::class, 'index']);

Application::get('/products', [App\Controllers\ProductController::class, 'index']);
Application::get('/products/{id}', [App\Controllers\ProductController::class, 'show']);

Application::get('/admin', [App\Controllers\AdminController::class, 'index']);
Application::get('/admin/products', [App\Controllers\AdminController::class, 'products']);
Application::post('/admin/products/filter', [App\Controllers\AdminController::class, 'filterProduct']);
Application::get('/admin/products/create', [App\Controllers\AdminController::class, 'createProduct']);
Application::post('/admin/products/create', [App\Controllers\AdminController::class, 'createProduct']);
Application::get('/admin/products/{id}/edit', [App\Controllers\AdminController::class, 'editProduct']);
Application::post('/admin/products/{id}/edit', [App\Controllers\AdminController::class, 'editProduct']);
Application::get('/admin/products/{id}/delete', [App\Controllers\AdminController::class, 'deleteProduct']);

Application::get('/admin/users', [App\Controllers\AdminController::class, 'users']);

Application::get('/cart', [App\Controllers\CartController::class, 'index']);
Application::post('/cart/add/{productId}', [App\Controllers\CartController::class, 'add']);
Application::post('/cart/remove/{productId}', [App\Controllers\CartController::class, 'remove']);

Application::get('/login', [App\Controllers\AuthController::class, 'login']);
Application::post('/login', [App\Controllers\AuthController::class, 'login']);

Application::get('/register', [App\Controllers\AuthController::class, 'register']);
Application::post('/register', [App\Controllers\AuthController::class, 'register']);

Application::get('/logout', function() {
	Application::$app->unsetUser();
	Application::$app->response->redirect('/');
});