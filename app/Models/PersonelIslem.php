<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonelIslem extends Model
{
    protected $guarded = [];

    static function getPersonelName($id) {
        $data = Personel::where('id', $id)->get();
        return $data[0]['ad'];
    }

    static function getTarih($id){
        $data = PersonelIslem::where('id',$id)->get();
        return Carbon::parse($data[0]['tarih']);

    }
    static function getTarihFormatted($id){
        $data = PersonelIslem::where('id',$id)->get();
        return Carbon::parse($data[0]['tarih'])->format('d/m/Y');

    }
}
