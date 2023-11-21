<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesmanDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Salesman.dashboard');
    }
    public function customers(){
        return view('Salesman.customers');
    }
    public function sales(){
        return view('Salesman.sales');
    }
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_users()
    {
        // View all the items
        $json = file_get_contents('app-assets/data/user-list.json');
        $json = json_decode($json);
        return $json;
    }
    public function products(){
        return view('Salesman.products');    
    }
    
    public function announcements(){
        return view('Salesman.announcements');
    }
    public function profile(){
        return view('Salesman.profile');
    }
    


}
