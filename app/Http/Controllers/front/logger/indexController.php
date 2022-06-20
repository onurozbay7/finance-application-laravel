<?php

namespace App\Http\Controllers\front\logger;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {

        return view('front.logger.index');
    }


    public function data(Request $request)
    {
        $table = Logger::query();
        $data = DataTables::of($table)
            ->addColumn('tarih', function ($table){
                return Logger::getTarih($table->id);
            })
            ->make(true);
        return $data;
    }
}
