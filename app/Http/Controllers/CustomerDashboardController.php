<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        return view('Client.dashboard');
}
 
     public function products(){
         return view('Client.products');
    }
     
      public function profile(){
         return view('Client.profile');
    }
     
}
