<?php

namespace App\Http\Controllers\front\home;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        $logger = Logger::orderBy('created_at','desc')->limit(20)->get();
        return view('front.home.index',['logger'=>$logger]);
    }
}
