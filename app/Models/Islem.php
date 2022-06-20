<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Islem extends Model
{
    protected $guarded = [];

    static function getTip($id) {
        $data = Islem::where('id',$id)->get();
        if($data[0]['tip'] == ISLEM_ODEME) {
            return "Ödeme";
        }
        else {
            return "Tahsilat";
        }
    }







    static function getCreated_at($id){
        $data = Islem::where('id',$id)->get();
        $created = $data[0]['created_at'];
        $fTarih = $data[0]['tarih'];

        $fark = $created->diffInDays($fTarih,false);
        $saatFark = $created->diffInHours($fTarih,false);

        if($saatFark<0){
            return $fark;
        }
        else if ($saatFark>0) {
            return $fark+1;
        }

    }


}
