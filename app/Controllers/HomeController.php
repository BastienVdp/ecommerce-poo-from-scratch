<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Models\Product;
use App\Core\Controller;
use App\Core\Application;

class HomeController extends Controller
{
    public function index()
    {       
        return View::make('home/index');
    } 
}
