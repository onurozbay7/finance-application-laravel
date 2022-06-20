<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musteriler extends Model
{
    protected $guarded = [];

    static function getPublicName($id){
        $data = Musteriler::where('id',$id)->get();
        if($data[0]['musteriTipi'] == 0){
            return $data[0]['ad']." ".$data[0]['soyad'];
        }
        else {
            return $data[0]['firmaAdi'];
        }
    }

    static function getPhoto($id) {
        $data = Musteriler::where('id',$id)->get();
        if($data[0]['photo'] != ""){
            return $data[0]['photo'];

        }
        else {
            return "assets/demo/users/default-profile.png";
        }
    }
}
