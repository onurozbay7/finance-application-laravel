<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPermission extends Model
{
    protected $guarded = [];

    static function getControl($userId,$permissionId)
    {
        $c = UserPermission::where('userId',$userId)->where('permissionId',$permissionId)->count();
        return ($c!=0) ? true : false;
    }

    static function getMyControl($permissionId)
    {
        if(Auth::user()->permission == 1){ return true; }
        $c = UserPermission::where('userId',Auth::id())->where('permissionId',$permissionId)->count();
        return ($c!=0) ? true : false;
    }
}
