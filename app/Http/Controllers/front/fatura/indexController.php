<?php

namespace App\Http\Controllers\front\fatura;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Kalem;
use App\Models\Musteriler;
use Illuminate\Http\Request;
use Monolog\Logger;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{


    public function index()
    {
        return view('front.fatura.index');

    }

    public function create($type)
    {
        if($type == 0){
            return view('front.fatura.gelir.create');
        }
        else {
            return view('front.fatura.gider.create');
        }
    }




    public function store(Request $request)
    {
        $type = $request->route('type');
        $all = $request->except('_token');

        $islem = $all['islem'];
        unset($all['islem']);
        $all['faturaTipi'] = $type;
        $c = Fatura::where('faturaNo',$all['faturaNo'])->count();
        if ($c == 0){
            $create = Fatura::create($all);
            if($create){
                if (count($islem) !=0) {
                    foreach ($islem as $k => $v) {
                        $islemArray = [
                            'faturaId' => $create->id,
                            'kalemId' => $v['kalemId'],
                            'miktar' => $v['adet'],
                            'fiyat' => $v['tutar'],
                            'araToplam' => $v['toplam_tutar'],
                            'kdvToplam' => $v['kdv_toplam'],
                            'genelToplam' => $v['genel_toplam'],
                            'text' => $v['text']
                        ];
                        FaturaIslem::create($islemArray);
                    }
                }
                return redirect()->back()->with('status','Fatura Başarıyla Eklendi');
            }
            else {
                return redirect()->back()->with('statusDanger','Fatura Eklenemedi');
            }
        }
        else {
            return redirect()->back()->with('statusDanger','Fatura zaten mevcut.');
        }

    }

    public function edit($id)
    {
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {
            $data = Fatura::where('id', $id)->get();
            $dataIslem = FaturaIslem::where('faturaId',$id)->get();

            if($data[0]['faturaTipi'] == 0) {
                //gelir
                return view('front.fatura.gelir.edit', ['data' => $data,'dataIslem'=>$dataIslem]);

            }
            return view('front.fatura.gider.edit', ['data' => $data, 'dataIslem' => $dataIslem]);
        } else {
            return redirect('/');
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $islem = $all['islem'];
            unset($all['islem']);


            if (count($islem) !=0) {
                FaturaIslem::where('faturaId',$id)->delete();
                foreach ($islem as $k => $v){
                    $islemArray = [
                        'faturaId' => $id,
                        'kalemId' => $v['kalemId'],
                        'miktar' => $v['adet'],
                        'fiyat' => $v['tutar'],
                        'araToplam' => $v['toplam_tutar'],
                        'kdvToplam' => $v['kdv_toplam'],
                        'genelToplam' => $v['genel_toplam'],
                        'text' => $v['text']
                    ];
                    FaturaIslem::create($islemArray);
                }
            }

            $update = Fatura::where('id', $id)->update($all);

            if ($update) {
                return redirect()->back()->with('status', 'Fatura Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('statusDanger', 'Fatura Güncellenemedi');
            }
        } else {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {
            $data = Fatura::where('id', $id)->get();
            Fatura::where('id', $id)->delete();

            FaturaIslem::where('faturaId', $id)->delete();

            return redirect()->back()->with('status', 'Fatura Başarıyla Silindi');
        } else {
            return redirect('/')->with('statusDanger', 'Fatura Silinemedi');
        }
    }

    public function data(Request $request)
    {
        $table = Fatura::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('fatura.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('fatura.delete', ['id' => $table->id]) . '">Sil</a>';
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->editColumn('faturaTipi', function ($table) {
                if ($table->faturaTipi == 0) {
                    return "Gelir";
                } else {
                    return "Gider";
                }
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }
}


