<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalem extends Model
{
    protected $guarded = [];


    static function getList($type){
        $list = Kalem::where('kalemTipi',$type)->get();
        return $list;
    }


    static function getKdv($id){
        $data = Kalem::where('id',$id)->get();

        return $data[0]['kdv'];
    }
}
