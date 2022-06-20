<?php

namespace App\Http\Controllers\front\kapak;

use App\Http\Controllers\Controller;
use App\Models\KapakOlculeri;
use App\Models\Logger;
use App\Models\Kapak;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.kapak.index');

    }

    public function create()
    {
        return view('front.kapak.create');

    }




    public function store(Request $request)
    {

        $all = $request->except('_token');

        $kapak = $all['kapak'];
        unset($all['kapak']);
        $c = Kapak::where('faturaNo',$all['faturaNo'])->count();
        if ($c == 0){
            $create = Kapak::create($all);
            if($create){
                Logger::Insert($all['faturaNo']." fişine ait Ürün Eklendi","Ürün");

                if (count($kapak) !=0) {
                    foreach ($kapak as $k => $v) {
                        $kapakArray = [
                            'urunId' => $create->id,
                            'boy' => $v['boy'],
                            'en' => $v['en'],
                            'adet' => $v['adet'],
                            'model' => $v['model'],
                            'tac' => $v['tac'],
                            'parca' => $v['parca'],
                            'text' => $v['text']
                        ];
                        KapakOlculeri::create($kapakArray);
                    }
                }
                return redirect()->back()->with('status','Kapak Başarıyla Eklendi');
            }
            else {
                return redirect()->back()->with('statusDanger','Kapak Eklenemedi');
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
            $c = Kapak::where('id', $id)->count();
            if ($c != 0) {
                $data = Kapak::where('id', $id)->get();
                $dataIslem = KapakOlculeri::where('urunId', $id)->get();

                return view('front.kapak.edit', ['data' => $data, 'dataIslem' => $dataIslem]);

            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Kapak::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $kapak = $all['kapak'];
            unset($all['kapak']);

            $data = Kapak::where('id',$id)->get();

            Logger::Insert($data[0]['faturaNo']." fişine ait Ürün Düzenlendi","Ürün");



            if (count($kapak) !=0) {
                KapakOlculeri::where('urunId',$id)->delete();
                foreach ($kapak as $k => $v){
                    $kapakArray = [
                        'urunId' => $id,
                        'boy' => $v['boy'],
                        'en' => $v['en'],
                        'adet' => $v['adet'],
                        'model' => $v['model'],
                        'tac' => $v['tac'],
                        'parca' => $v['parca'],
                        'text' => $v['text']
                    ];
                    KapakOlculeri::create($kapakArray);
                }
            }

            $update = Kapak::where('id', $id)->update($all);

            if ($update) {
                return redirect()->back()->with('status', 'Kapak Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('statusDanger', 'Kapak Güncellenemedi');
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
            $c = Kapak::where('id', $id)->count();

            if ($c != 0) {
                $data = Kapak::where('id', $id)->get();
                Kapak::where('id', $id)->delete();
                KapakOlculeri::where('urunId', $id)->delete();
                Logger::Insert($data[0]['faturaNo'] . " fişine ait Ürün Silindi", "Ürün");
                return redirect()->back()->with('status', 'Ürün Başarıyla Silindi');
            } else {
                return redirect('/')->with('statusDanger', 'Ürün Silinemedi');
            }

        }
    }

    public function detay($id){
        $c = Kapak::where('id',$id)->count();
        if($c!=0)
        {
            $olcuData = KapakOlculeri::where('urunId',$id)->get();
            $urunData = Kapak::where('id',$id)->get();


            return view('front.kapak.detay',['olcuData'=>$olcuData,'urunData'=>$urunData]);
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Kapak::query();
        $data = DataTables::of($table)

            ->addColumn('edit', function ($table) {
                return '<a href="' . route('kapak.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon d-print-none"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('kapak.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon d-print-none"></i></a>';
            })
            ->addColumn('detay', function ($table) {
                return '<a href="' . route('kapak.detay', ['id' => $table->id]) . '"><i title="Ürün Detayı" style="color:darkblue" class="feather feather-info list-icon d-print-none"></i></a>';
            })


            ->addColumn('formatTarih', function ($table){
                return Kapak::getTarihFormatted($table->id);
            })
            ->rawColumns(['edit', 'delete','detay'])
            ->make(true);
        return $data;
    }
}
