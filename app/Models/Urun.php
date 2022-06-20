<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    protected $guarded = [];

    static function getUrunName($id){

        $data = FaturaIslem::where('urunId',$id)->get();
        $dataUrun = Urun::where('id',$id)->get();

        if ($data[0]['urunId'] == 0){
            return "-";
        }
        else {
            return $dataUrun[0]['urunTipi'];
        }



    }
}
