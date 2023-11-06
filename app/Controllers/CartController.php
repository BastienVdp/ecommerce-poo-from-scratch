<?php 

namespace App\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Models\Order;
use App\Core\Response;
use App\Models\Product;
use App\Core\Controller;
use App\Core\Application;

class CartController extends Controller
{
	public function __construct()
	{
		$this->registerMiddleware([
			"class" => \App\Middlewares\AuthMiddleware::class,
			"actions" => ["checkout"]
		]);
	}
	public function index()
	{
		$products = Application::$app->session->get('cart');
		$totalCart = array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products));	
		
		return View::make('cart/index', [
			"productsInCart" =>  $products,
			"totalCart" => $totalCart
		]);
	}

	public function add(Request $request, Response $response)
	{
		$product = Product::find(['id' => $request->params['productId']]);
		$ressource = (array)$product;
		$cart = Application::$app->session->get('cart');

		if(!is_array($cart)) {
			$cart = [];
		}

		$key = array_search($product->id, array_column($cart, 'id'));

		if ($key !== false) {
			// Si l'élément existe déjà, incrémente la quantité
			$cart[$key]['quantity']++;
		} else {
			// Si l'élément n'existe pas, ajoute-le avec une quantité de 1
			$cart[] = [...$ressource, 'quantity' => 1];
		}

		Application::$app->session->set('cart', $cart);

		$response->redirect('/cart');
	}

	public function remove(Request $request, Response $response)
	{
		$cart = Application::$app->session->get('cart');
		
		if(!$key = array_search(
			$request->params['productId'], 
			array_column($cart, 'id'))
		) {
			if($cart[$key]['quantity'] > 1) {
				$cart[$key]['quantity']--;
			} else {
				unset($cart[$key]);
				$cart = array_values($cart);
			}
			Application::$app->session->set('cart', $cart);
		}

		$response->redirect('/cart');
	}

	public function checkout(Request $request, Response $response)
	{
		$products = Application::$app->session->get('cart');

		$totalCart = array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products));	

		// uniq id with 4 chars

		$order = Order::create([
			'number' => substr(uniqid(), -4),
			'total_price' => $totalCart,
			'user_id' => Application::$app->user->id
		]);

		$order->associate(Product::class, $products);

		Application::$app->session->set('cart', []);
		
		$response->redirect('/profile/orders/' . $order->id);
	}
}

