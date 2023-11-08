<?php 

namespace App\Controllers;

use App\Core\View;
use App\Core\Controller;
class HomeController extends Controller
{
    public function index()
    {       
        return View::make('home/index');
    } 
}
