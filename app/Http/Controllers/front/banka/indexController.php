<?php

namespace App\Http\Controllers\front\banka;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Logger;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view('front.banka.index');

    }
    public function transfer()
    {
        return view('front.banka.transfer');

    }

    public function create()
    {
        return view('front.banka.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $c1 = Banka::where('iban',$all['iban'])->count();
        $c2 = Banka::where('hesapNo',$all['hesapNo'])->count();


        if($c1 == 0 && $c2 == 0){

            $create = Banka::create($all);
            if ($create) {
                Logger::Insert("Banka Eklendi","Banka");
                return redirect()->back()->with('status', 'Banka Ekleme İşlemi Başarılı');

            } else {
                return redirect()->back()->with('statusDanger', 'Banka Eklenemedi');

            }

        }

        else if($c1 != 0) { return redirect()->back()->with('statusDanger', 'Iban numarası zaten mevcut.'); }

        else if($c2 != 0) { return redirect()->back()->with('statusDanger', 'Hesap numarası zaten mevcut.'); }

        else { return redirect()->back()->with('statusDanger', 'Banka zaten mevcut.'); }



    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Banka::where('id', $id)->count();
            if ($c != 0) {
                $data = Banka::where('id', $id)->get();
                return view('front.banka.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Banka::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $data = Banka::where('id', $id)->get();


            $update = Banka::where('id', $id)->update($all);
            if ($update) {
                Logger::Insert($data[0]['ad']." Bankası Düzenlendi","Banka");
                return redirect()->back()->with('status', 'Banka Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('status', 'Banka Güncellenemedi');
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
            $c = Banka::where('id', $id)->count();
            if ($c != 0) {
                $data = Banka::where('id', $id)->get();
                Logger::Insert($data[0]['ad'] . " Bankası Silindi", "Banka");
                Banka::where('id', $id)->delete();

                return redirect()->back()->with('status', 'Banka Başarıyla Silindi');
            } else {
                return redirect('/')->with('status', 'Banka Silinemedi');
            }
        }
    }

    public function data(Request $request)
    {
        $table = Banka::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('banka.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('banka.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }

    public function transferYap(Request $request) {
        $all = $request->except('_token');

        $transferTutar = $all['tutar'];

        $gonderenData = Banka::where('id',$all['gonderenHesap'])->get();
        $yatirilanData = Banka::where('id',$all['yatirilanHesap'])->get();

        $gonderenTutar = $gonderenData[0]['bakiye'] - $transferTutar;
        $yatirilanTutar = $yatirilanData[0]['bakiye'] + $transferTutar;

        if($gonderenData[0]['id'] == $yatirilanData[0]['id']) {
            return redirect()->back()->with('statusDanger',"Aynı hesaplar arasında işlem yapılamaz.");
        }

        else if($gonderenData[0]['bakiye'] < $transferTutar) {
            return redirect()->back()->with('statusDanger',"Gönderen hesapta yeterli bakiye yok.");
        }
        else {
            $gonderenUpdate = Banka::where('id', $all['gonderenHesap'])->update(['bakiye' => $gonderenTutar]);
            $yatirilanUpdate = Banka::where('id', $all['yatirilanHesap'])->update(['bakiye' => $yatirilanTutar]);

            if ($gonderenUpdate && $yatirilanUpdate) {
                Logger::Insert($gonderenData[0]['ad'] . " => " . $yatirilanData[0]['ad'] . " " . $transferTutar . " TL transfer yapıldı.", "Banka");
                return redirect()->back()->with('status', $gonderenData[0]['ad'] . " hesabından " . $yatirilanData[0]['ad'] . " hesabına " . $transferTutar . " TL transfer yapıldı.");
            } else {
                return redirect()->back()->with('status', 'Transfer Yapılamadı.');
            }

        }



    }


}
