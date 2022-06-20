<?php

namespace App\Models;

use Carbon\Carbon;
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

    static function getTarih($id){
        $data = Fatura::where('id',$id)->get();
        return Carbon::parse($data[0]['faturaTarih']);

    }

    static function getTarihFormatted($id){
        $data = Fatura::where('id',$id)->get();
        return Carbon::parse($data[0]['faturaTarih'])->format("d/m/Y");

    }

    static function getKalanTutar($id){
        $faturaData = FaturaIslem::where('faturaId',$id)->sum('genelToplam');
        $islemData = Islem::where('faturaId',$id)->sum('fiyat');

        return  number_format($faturaData - $islemData, 2, '.', ',');
    }
    static function getKalanTutarInt($id){
        $faturaData = FaturaIslem::where('faturaId',$id)->sum('genelToplam');
        $islemData = Islem::where('faturaId',$id)->sum('fiyat');

        return  $faturaData - $islemData;
    }

    static function getCreated_at($id){
        $data = Fatura::where('id',$id)->get();
        $created = $data[0]['created_at'];
        $fTarih = $data[0]['faturaTarih'];

        $fark = $created->diffInDays($fTarih,false);
        $saatFark = $created->diffInHours($fTarih,false);

        if($saatFark<0){
            return $fark;
        }
        else if ($saatFark>0) {
            return $fark+1;
        }

    }

    static function getFaturaIslems($id) {
      return FaturaIslem::where('faturaId',$id)->get();


    }

    static function getKdv($id) {
        $data = FaturaIslem::where('faturaId',$id)->get();

        return $data[0]['kdv'];


    }
}
