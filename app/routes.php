<?php 
/* 
 * The code you provided is defining routes for a PHP application 
 * using the Application class from the App\Core namespace. 
 * Each route is associated with a specific URL and a corresponding 
 * controller method that will be executed when that URL is accessed. 
 */
use App\Core\Application;

Application::get('/', [App\Controllers\HomeController::class, 'index']);

Application::get('/profile', [App\Controllers\ProfileController::class, 'index']);
Application::get('/profile/orders', [App\Controllers\ProfileController::class, 'orders']);
Application::get('/profile/orders/{id}', [App\Controllers\ProfileController::class, 'order']);


Application::get('/products', [App\Controllers\ProductController::class, 'index']);
Application::get('/products/{id}', [App\Controllers\ProductController::class, 'show']);
Application::get('/products/category/{id}', [App\Controllers\ProductController::class, 'filter']);
Application::get('/products/sort/{filter}/{order}', [App\Controllers\ProductController::class, 'sort']);

Application::get('/admin', [App\Controllers\AdminController::class, 'index']);
Application::get('/admin/products', [App\Controllers\AdminController::class, 'products']);
Application::get('/admin/products/create', [App\Controllers\ProductController::class, 'create']);
Application::post('/admin/products/create', [App\Controllers\ProductController::class, 'store']);
Application::get('/admin/products/{id}/edit', [App\Controllers\ProductController::class, 'edit']);
Application::post('/admin/products/{id}/edit', [App\Controllers\ProductController::class, 'update']);
Application::get('/admin/products/{id}/delete', [App\Controllers\ProductController::class, 'delete']);

Application::get('/admin/categories', [App\Controllers\CategoryController::class, 'index']);
Application::get('/admin/categories/create', [App\Controllers\CategoryController::class, 'create']);
Application::post('/admin/categories/create', [App\Controllers\CategoryController::class, 'store']);
Application::get('/admin/categories/{id}/edit', [App\Controllers\CategoryController::class, 'edit']);
Application::post('/admin/categories/{id}/edit', [App\Controllers\CategoryController::class, 'update']);
Application::get('/admin/categories/{id}/delete', [App\Controllers\CategoryController::class, 'delete']);

Application::get('/admin/users', [App\Controllers\AdminController::class, 'users']);

Application::get('/cart', [App\Controllers\CartController::class, 'index']);
Application::post('/cart/add/{productId}', [App\Controllers\CartController::class, 'add']);
Application::post('/cart/remove/{productId}', [App\Controllers\CartController::class, 'remove']);
Application::post('/cart/checkout', [App\Controllers\CartController::class, 'checkout']);

Application::get('/login', [App\Controllers\AuthController::class, 'login']);
Application::post('/login', [App\Controllers\AuthController::class, 'login']);

Application::get('/register', [App\Controllers\AuthController::class, 'register']);
Application::post('/register', [App\Controllers\AuthController::class, 'register']);

Application::get('/logout', function() {
	Application::$app->unsetUser();
	Application::$app->response->redirect('/');
});