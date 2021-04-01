<?php

namespace App\Http\Controllers;


use App\Events\RealTimeMessage;

class TestController extends Controller
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

    public function testpusher()
    {
        //event(new RealTimeMessage('Hello World'));
        return view('test.pusher');
    }
    
    
    public function testpusher_privat()
    {
        //event(new RealTimeMessage('Hello World'));
        return view('test.pusher_privat');
    }
}
