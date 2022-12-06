<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Menu;

class WelcomeController extends Controller
{
    public function index()
    {        
         $menus = Menu::all();
    
        return view('welcome',compact('menus'));
    }
    public function thankyou()
    {
        return view('thankyou');
    }
}
