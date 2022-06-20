<?php

namespace App\Http\Controllers\front\notlar;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use App\Models\Notlar;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.notlar.index');

    }
    public function transfer()
    {
        return view('front.notlar.transfer');

    }

    public function create()
    {
        return view('front.notlar.create');
    }

    public function store(Request $request)
    {
        $baslik = $request->input('baslik');
        $icerik = $request->input('icerik');

        $userName = Auth::user()->name;
        $userId = Auth::user()->id;

            $create = Notlar::create(['userId' => $userId,'userName' => $userName,'baslik' => $baslik,'icerik' => $icerik]);
            if ($create) {
                Logger::Insert("Not Eklendi","Not");
                return redirect()->back()->with('status', 'Not Ekleme İşlemi Başarılı');

            } else {
                return redirect()->back()->with('statusDanger', 'Not Eklenemedi');

            }






    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Notlar::where('id', $id)->count();
            if ($c != 0) {
                $data = Notlar::where('id', $id)->get();
                return view('front.notlar.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Notlar::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $data = Notlar::where('id', $id)->get();


            $update = Notlar::where('id', $id)->update($all);
            if ($update) {
                Logger::Insert($data[0]['baslik']." Notu Düzenlendi","Not");
                return redirect()->back()->with('status', 'Not Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('status', 'Not Güncellenemedi');
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
            $c = Notlar::where('id', $id)->count();
            if ($c != 0) {
                $data = Notlar::where('id', $id)->get();
                Logger::Insert($data[0]['baslik'] . " Notu Silindi", "Banka");
                Notlar::where('id', $id)->delete();

                return redirect()->back()->with('status', 'Not Başarıyla Silindi');
            } else {
                return redirect('/')->with('status', 'Not Silinemedi');
            }
        }
    }

    public function data(Request $request)
    {
        $table = Notlar::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('notlar.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('notlar.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->addColumn('tarih', function ($table){
                return Notlar::getTarih($table->id);
            })
            ->addColumn('ayrinti', function ($table){
                $data = Notlar::getAll($table->id);
                return '<a href="#" data-tarih="'.Notlar::getTarih($table->id).'" data-baslik="'.$data[0]['baslik'].'" data-userName="'.$data[0]['userName'].'" data-icerik="'.$data[0]['icerik'].'" class="ayrinti" ><i title="Ayrıntı" style="color:darkblue" class="feather feather-info list-icon"></i></a>';
            })
            ->rawColumns(['edit', 'delete','ayrinti'])
            ->make(true);
        return $data;
    }
}
