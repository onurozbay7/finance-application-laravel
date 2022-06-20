<?php

namespace App\Http\Controllers\front\kapi;

use App\Http\Controllers\Controller;
use App\Models\KapiOlculeri;
use App\Models\Logger;
use App\Models\Kapi;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.kapi.index');

    }

    public function create()
    {
            return view('front.kapi.create');

    }




    public function store(Request $request)
    {

        $all = $request->except('_token');

        $kapi = $all['kapi'];
        unset($all['kapi']);
        $c = Kapi::where('faturaNo',$all['faturaNo'])->count();
        if ($c == 0){
            $create = Kapi::create($all);
            if($create){
                    Logger::Insert($all['faturaNo']." fişine ait Ürün Eklendi","Ürün");

                if (count($kapi) !=0) {
                    foreach ($kapi as $k => $v) {
                        $kapiArray = [
                            'urunId' => $create->id,
                            'boy' => $v['boy'],
                            'en' => $v['en'],
                            'kasa' => $v['kasa'],
                            'adet' => $v['adet'],
                            'kenar' => $v['kenar'],
                            'model' => $v['model'],
                            'renk' => $v['renk'],
                            'text' => $v['text']
                        ];
                        KapiOlculeri::create($kapiArray);
                    }
                }
                return redirect()->back()->with('status','Kapı Başarıyla Eklendi');
            }
            else {
                return redirect()->back()->with('statusDanger','Kapı Eklenemedi');
            }
        }
        else {
            return redirect()->back()->with('statusDanger','Fişe ait ürün zaten mevcut.');
        }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Kapi::where('id', $id)->count();
            if ($c != 0) {
                $data = Kapi::where('id', $id)->get();
                $dataIslem = KapiOlculeri::where('urunId', $id)->get();

                return view('front.kapi.edit', ['data' => $data, 'dataIslem' => $dataIslem]);

            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Kapi::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $kapi = $all['kapi'];
            unset($all['kapi']);

            $data = Kapi::where('id',$id)->get();

            Logger::Insert($data[0]['faturaNo']." fişine ait Ürün Düzenlendi","Ürün");



            if (count($kapi) !=0) {
                KapiOlculeri::where('urunId',$id)->delete();
                foreach ($kapi as $k => $v){
                    $kapiArray = [
                        'urunId' => $id,
                        'boy' => $v['boy'],
                        'en' => $v['en'],
                        'kasa' => $v['kasa'],
                        'adet' => $v['adet'],
                        'kenar' => $v['kenar'],
                        'model' => $v['model'],
                        'renk' => $v['renk'],
                        'text' => $v['text']
                    ];
                    KapiOlculeri::create($kapiArray);
                }
            }

            $update = Kapi::where('id', $id)->update($all);

            if ($update) {
                return redirect()->back()->with('status', 'Kapı Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('statusDanger', 'Kapı Güncellenemedi');
            }
        } else {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        if(!UserPermission::getMyControl(7)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Kapi::where('id', $id)->count();

            if ($c != 0) {
                $data = Kapi::where('id', $id)->get();
                Kapi::where('id', $id)->delete();
                KapiOlculeri::where('urunId', $id)->delete();
                Logger::Insert($data[0]['faturaNo'] . " fişine ait Ürün Silindi", "Ürün");
                return redirect()->back()->with('status', 'Ürün Başarıyla Silindi');
            } else {
                return redirect('/')->with('statusDanger', 'Ürün Silinemedi');
            }

        }
    }

    public function detay($id){
        $c = Kapi::where('id',$id)->count();
        if($c!=0)
        {
            $olcuData = KapiOlculeri::where('urunId',$id)->get();
            $urunData = Kapi::where('id',$id)->get();


            return view('front.kapi.detay',['olcuData'=>$olcuData,'urunData'=>$urunData]);
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Kapi::query();
        $data = DataTables::of($table)

            ->addColumn('edit', function ($table) {
                return '<a href="' . route('kapi.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon d-print-none"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('kapi.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon d-print-none"></i></a>';
            })
            ->addColumn('detay', function ($table) {
                return '<a href="' . route('kapi.detay', ['id' => $table->id]) . '"><i title="Ürün Detayı" style="color:darkblue" class="feather feather-info list-icon d-print-none"></i></a>';
            })


            ->addColumn('formatTarih', function ($table){
                return Kapi::getTarihFormatted($table->id);
            })
            ->rawColumns(['edit', 'delete','detay'])
            ->make(true);
        return $data;
    }
}
