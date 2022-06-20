<?php

namespace App\Http\Controllers\front\personel;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use App\Models\Personel;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.personel.index');

    }

    public function create()
    {
        return view('front.personel.create');
    }

    public function store(Request $request)
    {
        $id = $request->route('id');
        $all = $request->except('_token');

        $c1 = Personel::where('ad',$all['ad'])->count();

        if($c1 == 0){

            $create = Personel::create($all);
            if ($create) {
                Logger::Insert("Personel Eklendi","Personel");
                return redirect()->back()->with('status', 'Personel Ekleme İşlemi Başarılı');

            } else {
                return redirect()->back()->with('statusDanger', 'Personel Eklenemedi');

            }
        }
        else { return redirect()->back()->with('statusDanger', 'Personel zaten mevcut.'); }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Personel::where('id', $id)->count();
            if ($c != 0) {
                $data = Personel::where('id', $id)->get();
                return view('front.personel.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Personel::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $data = Personel::where('id', $id)->get();


            $update = Personel::where('id', $id)->update($all);
            if ($update) {
                Logger::Insert($data[0]['ad']." Personeli Düzenlendi","Personel");
                return redirect()->back()->with('status', 'Personel Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('status', 'Personel Güncellenemedi');
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
            $c = Personel::where('id', $id)->count();
            if ($c != 0) {
                $data = Personel::where('id', $id)->get();
                Logger::Insert($data[0]['ad'] . " Personeli Silindi", "Personel");
                Personel::where('id', $id)->delete();

                return redirect()->back()->with('status', 'Personel Başarıyla Silindi');
            } else {
                return redirect('/')->with('status', 'Personel Silinemedi');
            }
        }
    }

    public function data(Request $request)
    {
        $table = Personel::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('personel.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('personel.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }
}
