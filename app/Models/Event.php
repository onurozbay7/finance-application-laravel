<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'start', 'end'
    ];

    static function getTodayPlan(){
        $today = Carbon::now()->format('Y-m-d');
        return Event::where('start',$today)->get();
    }

    static function getSoonPlan(){
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $threeday = Carbon::tomorrow()->addDays(2);
        return Event::where('start','>=',$tomorrow)->where('start','<=',$threeday)->get();
    }

    static function getStartDate($id){
        $data = Event::where('id',$id)->get();

        return Carbon::parse($data[0]['start'])->format('d/m/Y');
    }
}
