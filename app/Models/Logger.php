<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Logger extends Model
{

    public $timestamps = [ "created_at" ]; // enable only to created_at
    protected $guarded = [];

    static function Insert($text,$islem) {
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        Logger::create(['userId' => $userId,'userName' => $userName,'text' => $text,'islem' => $islem]);
    }

    static function getUserPhoto($id) {
        $data = User::where('id',$id)->get();
        if($data[0]['photo'] ==""){
            return "assets/demo/users/default-profile.png";
        }
        else {
            return $data[0]['photo'];
        }

    }

    static function loggerVarMi() {
        if(Logger::count() != 0){
            return 1;
        }
        else {
            return 0;
        }
    }

    static function getTarih($id){
        $data = Logger::where('id',$id)->get();
        return Carbon::parse($data[0]['created_at'])->format('d/m/Y');

    }
}
