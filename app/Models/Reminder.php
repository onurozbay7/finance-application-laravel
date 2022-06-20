<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    static function FaturaHatirlatici() {

        $returnArray = [];

        if(Fatura::count() != 0)
        {
            $list = Fatura::all();
            foreach ($list as $k => $v)
            {
                if($v['faturaTipi'] == 0)
                {
                    // Gelir Faturası
                    $c = Islem::where('tip',ISLEM_TAHSILAT)->where('faturaId',$v['id'])->count();
                    $type = "Tahsilat";
                    $uri = route('islem.create',['type'=>ISLEM_TAHSILAT, 'id' => $v['id']]);
                }
                else
                {
                    // Gider Faturası
                    $c = Islem::where('tip',ISLEM_ODEME)->where('faturaId',$v['id'])->count();
                    $type = "Ödeme";
                    $uri = route('islem.create',['type'=>ISLEM_ODEME, 'id' => $v['id']]);
                }

                if(Fatura::getKalanTutar($v['id']) != 0)
                {
                    $returnArray[$k]['name'] = $v['faturaNo']." - ".Musteriler::getPublicName($v['musteriId'])." - " .$type;
                    $returnArray[$k]['musteriId'] = $v['musteriId'];
                    $returnArray[$k]['fiyat'] = number_format(Fatura::getTotal($v['id']), 2, '.', ',');
                    $returnArray[$k]['kalanTutar'] = Fatura::getKalanTutar($v['id']);
                    $returnArray[$k]['uri'] = $uri;
                }

            }

        }
        return $returnArray;
    }
}
