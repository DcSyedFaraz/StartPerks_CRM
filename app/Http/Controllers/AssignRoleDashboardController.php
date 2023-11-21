<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignRoleDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
    
        if (Auth::user()->hasRole('Admin')) {
            return redirect('/admin_dashboard');
        }
        elseif(Auth::user()->hasRole('Salesman')){
            return redirect('/salesman_dashboard');
        }
        elseif(Auth::user()->hasRole('Customer')){
            return redirect('/client/dashboard');
        }
        else{
            auth()->logout();
            return redirect('/login');
            
        }
       
    }
    
}
