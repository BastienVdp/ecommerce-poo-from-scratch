<?php 

namespace App\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Models\Order;
use App\Core\Controller;
use App\Core\Application;

class ProfileController extends Controller
{
    public string $layout = 'profile';
    
    public function __construct()
    {
        $this->registerMiddleware([
            'class' => \App\Middlewares\AuthMiddleware::class,
            'actions' => ['index', 'orders', 'order']
        ]);
    }
    
    public function index()
    {
        return View::make('profile/index');
    }

    public function orders()
    {
        $orders = Application::$app->user->orders();

        return View::make('profile/orders/index', [
            'orders' => $orders
        ]);
    }

    public function order(Request $request)
    {
        return View::make('profile/orders/show', [
            'order' => Order::find(['id' => $request->params['id']])
        ]);
    }
}
