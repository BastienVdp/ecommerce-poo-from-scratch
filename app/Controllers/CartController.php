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

	/**
	 * The index function retrieves the products in the cart from the session, calculates the total cart
	 * value, and returns a view with the products and total cart value.
	 * 
	 * @return a view with the data "productsInCart" and "totalCart".
	 */
	public function index()
	{
		$products = Application::$app->session->get('cart');
		$totalCart = array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products));	
		
		return View::make('cart/index', [
			"productsInCart" =>  $products,
			"totalCart" => $totalCart
		]);
	}

	/**
	 * The function adds a product to the cart and updates the session data.
	 * 
	 * @param Request request The  parameter is an instance of the Request class, which represents
	 * an HTTP request. It contains information about the request such as the request method, headers, and
	 * parameters.
	 * @param Response response The  parameter is an instance of the Response class, which is
	 * used to send a response back to the client. It can be used to set the response status code,
	 * headers, and body content. In this code snippet, the  object is used to redirect the user
	 * to the "/cart
	 */
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
			$cart[$key]['quantity']++;
		} else {
			$cart[] = [...$ressource, 'quantity' => 1];
		}

		Application::$app->session->set('cart', $cart);

		$response->redirect('/cart');
	}

	/**
	 * The function removes a product from the cart and updates the session data, then redirects the user
	 * to the cart page.
	 * 
	 * @param Request request The  parameter is an instance of the Request class, which represents
	 * an HTTP request. It contains information about the request, such as the request method, headers,
	 * and parameters.
	 * @param Response response The  parameter is an instance of the Response class, which is
	 * used to send the HTTP response back to the client. It is used to redirect the user to the '/cart'
	 * page after removing the product from the cart.
	 */
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

	/**
	 * The function performs a checkout process by calculating the total price of the products in the
	 * cart, creating an order with a unique number and associating the products with the order, clearing
	 * the cart, and redirecting the user to their order profile page.
	 * 
	 * @param Request request The  parameter is an instance of the Request class, which represents
	 * an HTTP request made to the server. It contains information such as the request method, headers,
	 * and request data.
	 * @param Response response The  parameter is an instance of the Response class, which is
	 * used to send a response back to the client. It can be used to set headers, cookies, and redirect
	 * the user to a different page. In this case, the redirect method is used to redirect the user to the
	 * "/profile
	 */
	public function checkout(Request $request, Response $response)
	{
		$products = Application::$app->session->get('cart');

		$totalCart = array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products));	

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

