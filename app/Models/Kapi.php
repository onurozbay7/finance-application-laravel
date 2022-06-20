<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapi extends Model
{
    protected $guarded = [];

    static function getTarihFormatted($id){
        $data = Kapi::where('id',$id)->get();
        return Carbon::parse($data[0]['tarih'])->format("d/m/Y");

    }
}
