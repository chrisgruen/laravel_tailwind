<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function welcome()
    {
        //event(new RealTimeMessage('Hello World'));
        return view('welcome');
    }
    
    public function index()
    {
        return view('content.index');
    }
    
    public function content($pageContent)
    {
        if (view()->exists("content." . $pageContent)) {
            return view("content." . $pageContent);
        } else {
            abort(404);
        }
    }
    
}
