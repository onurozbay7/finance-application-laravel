<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $guarded = [];

    static function getList($type) {
        return Fatura::where('faturaTipi',$type)->get();
    }

    static function getMusteriList($id) {
        return Fatura::where('musteriId',$id)->get();
    }

    static function getTotal($id) {
        return FaturaIslem::where('faturaId',$id)->sum('genelToplam');
    }

    static function getNo($id){
        $c = Fatura::where('id',$id)->count();
        if ($c != 0){
            $w = Fatura::where('id',$id)->get();
            return $w[0]['faturaNo'];
        }
        else {
            return "#";
        }
    }
    static function getGelirCount(){
        return Fatura::where('faturaTipi',FATURA_GELIR)->count();
    }

    static function getGiderCount(){
        return Fatura::where('faturaTipi',FATURA_GIDER)->count();
    }
}
