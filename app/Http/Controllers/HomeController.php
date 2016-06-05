<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->redirect();
    }

    public function redirect()
    {
        if(Auth::user()->role == "prof")
        {
            //var_dump(Auth::user()->role);
            return redirect()->route('prof_index' );
        }else if(Auth::user()->role == "eleve")
        {
            return redirect()->route('eleve_index' );
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}