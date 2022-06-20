<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Notlar extends Model
{
    protected $guarded = [];


    static function Insert($baslik,$icerik) {
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        Notlar::create(['userId' => $userId,'userName' => $userName,'text' => $baslik,'islem' => $icerik]);
    }

    static function getTarih($id){
        $data = Notlar::where('id',$id)->get();
        return Carbon::parse($data[0]['created_at'])->format('d/m/Y');

    }

    static function getAll($id){
        return Notlar::where('id',$id)->get();

    }

    static function sonNotlar(){
        return Notlar::latest()->take(5)->get();

    }
}
