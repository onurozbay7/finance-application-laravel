<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banka extends Model
{
    protected $guarded = [];

    static function getHesapName($id){
        $c = Banka::where('id',$id)->count();

        if($c != 0){
            $data = Banka::where('id',$id)->get();

            return $data[0]['ad'];
        }


    }
}
