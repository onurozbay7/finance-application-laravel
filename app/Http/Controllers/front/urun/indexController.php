<?php

namespace App\Http\Controllers\front\urun;

use App\Http\Controllers\Controller;
use App\Models\FaturaIslem;
use App\Models\KapiOlculeri;
use App\Models\Logger;
use App\Models\Kapi;
use App\Models\Urun;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.urun.index');

    }

    public function create()
    {
        return view('front.urun.create');

    }




    public function store(Request $request)
    {

        $all = $request->except('_token');


        $create = Urun::create($all);
        if($create){
            Logger::Insert("Ürün Eklendi","Ürün");
            return redirect()->back()->with('status','Ürün Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('statusDanger','Ürün Eklenemedi');
        }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Urun::where('id', $id)->count();
            if ($c != 0) {
                $data = Urun::where('id', $id)->get();

                return view('front.urun.edit', ['data' => $data]);

            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Urun::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            Logger::Insert("Ürün Düzenlendi","Ürün");

            $update = Urun::where('id', $id)->update($all);

            if ($update) {
                return redirect()->back()->with('status', 'Ürün Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('statusDanger', 'Ürün Güncellenemedi');
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
            $c = Urun::where('id', $id)->count();

            if ($c != 0) {
                Urun::where('id', $id)->delete();
                FaturaIslem::where('urunId',$id)->update(['urunId' => 0]);
                Logger::Insert(" Ürün Silindi", "Ürün");
                return redirect()->back()->with('status', 'Ürün Başarıyla Silindi');
            } else {
                return redirect('/')->with('statusDanger', 'Ürün Silinemedi');
            }

        }
    }

    public function stokEkle(Request $request){

        $id = $request->route('id');
        $data = Urun::where('id',$id)->get();

        $anlikStok = $data[0]['stok'];

        $gelenStok = $request->request->get('stokEkle');


        $sonuc = $anlikStok + $gelenStok;

        $update = Urun::where('id', $id)->update(['stok' => $sonuc]);

        if ($update) {
            return new JsonResponse(['Stok Başarıyla Eklendi'],200);

        } else {
            return new JsonResponse(['Stok Eklenemedi'],400);


        }
    }



    public function data(Request $request)
    {
        $table = Urun::query();
        $data = DataTables::of($table)

            ->addColumn('edit', function ($table) {
                return '<a href="' . route('urun.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon d-print-none"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('urun.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon d-print-none"></i></a>';
            })
            ->addColumn('stokEkle', function ($table) {
                return '<a class="stok" href="' . route('urun.stokEkle', ['id' => $table->id]) . '"><i title="Stok Ekle" style="color:darkblue" class="stok feather feather-plus-circle list-icon d-print-none"></i></a>';
            })
            ->editColumn('urunTarihi', function ($table) {
                return Carbon::parse($table->urunTarihi)->format("d/m/Y");
            })
            ->rawColumns(['edit', 'delete','stokEkle'])
            ->make(true);
        return $data;
    }
}
