<?php

namespace App\Http\Controllers\front\personelIslem;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Logger;
use App\Models\PersonelIslem;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.personelIslem.index');

    }

    public function create()
    {
        return view('front.personelIslem.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $banka = Banka::where('id',$all['hesap'])->get();
        $bakiye = $banka[0]['bakiye'];
        $bakiye = $bakiye - $all['tutar'];

        if($bakiye >= 0){

            $create = PersonelIslem::create($all);
            if ($create) {
                Banka::where('id',$all['hesap'])->update(['bakiye' => $bakiye]);
                Logger::Insert("Personele". $all['tutar'] ." TL Ödendi","Personel");
                return redirect()->back()->with('status', "Personele ". $all['tutar'] ." TL Ödendi");

            } else {
                return redirect()->back()->with('statusDanger', 'İşlem Başarısız');

            }

        }
        else {
            return redirect()->back()->with('statusDanger', 'Banka bakiyesi yetersiz');
        }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = PersonelIslem::where('id', $id)->count();
            if ($c != 0) {
                $data = PersonelIslem::where('id', $id)->get();
                return view('front.personelIslem.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = PersonelIslem::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $data = PersonelIslem::where('id', $id)->get();
            $banka = Banka::where('id',$data[0]['hesap'])->get();
            $yeniBanka = Banka::where('id',$all['hesap'])->get();
            $bakiye = $banka[0]['bakiye'];
            $yeniBankaBakiye = $yeniBanka[0]['bakiye'];
            $isTrue = false;

            if($data[0]['hesap'] != $all['hesap']) {
                $bakiye = $bakiye + $data[0]['tutar'];
                $yeniBankaBakiye = $yeniBankaBakiye - $all['tutar'];
                if($yeniBankaBakiye >= 0){
                    Banka::where('id',$data[0]['hesap'])->update(['bakiye' => $bakiye]);
                    Banka::where('id',$all['hesap'])->update(['bakiye' => $yeniBankaBakiye]);
                    $isTrue = true;
                }
                else {
                    $isTrue = false;
                }
            }
            else if($data[0]['tutar'] != $all['tutar']){
                $bakiye = $bakiye + $data[0]['tutar'];
                $bakiye = $bakiye - $all['tutar'];
                if($bakiye >= 0) {
                    Banka::where('id',$data[0]['hesap'])->update(['bakiye' => $bakiye]);
                    $isTrue = true;
                }
                else {
                    $isTrue = false;
                }

            }
            else {
                $isTrue = true;
            }

            if($isTrue == true) {
                $update = PersonelIslem::where('id', $id)->update($all);
                if ($update) {

                    Logger::Insert("Personel İşlemi Düzenlendi", "Personel");
                    return redirect()->back()->with('status', 'Personel İşlemi Başarıyla Güncellendi');
                } else {
                    return redirect()->back()->with('status', 'Personel İşlemi Güncellenemedi');
                }
            }
            else {
                return redirect()->back()->with('statusDanger', 'Banka bakiyesi yetersiz');
            }
        }
        else {
            return redirect('/');
        }
    }


    public function delete($id)
    {
        if(!UserPermission::getMyControl(7)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = PersonelIslem::where('id', $id)->count();
            if ($c != 0) {
                $data = PersonelIslem::where('id', $id)->get();
                $banka = Banka::where('id',$data[0]['hesap'])->get();
                $bakiye = $banka[0]['bakiye'];
                $bakiye = $bakiye + $data[0]['tutar'];
                Banka::where('id',$data[0]['hesap'])->update(['bakiye' => $bakiye]);
                Logger::Insert($data[0]['ad'] . " Personeli Silindi", "Personel");
                PersonelIslem::where('id', $id)->delete();

                return redirect()->back()->with('status', 'Personel Başarıyla Silindi');
            } else {
                return redirect('/')->with('status', 'Personel Silinemedi');
            }
        }
    }

    public function data(Request $request)
    {
        $table = PersonelIslem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('personelIslem.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('personelIslem.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->addColumn('personelAd', function ($table){
                return PersonelIslem::getPersonelName($table->personelId);
            })
            ->addColumn('tarih', function ($table){
                return PersonelIslem::getTarih($table->id);
            })
            ->addColumn('formatTarih', function ($table){
                return PersonelIslem::getTarihFormatted($table->id);
            })
            ->addColumn('avans', function ($table){
                if ($table->islemTipi == ISLEM_AVANS) {
                    return $table->tutar;
                } else {
                    return 0;
                }
            })
            ->addColumn('maas', function ($table){
                if ($table->islemTipi == ISLEM_MAAS) {
                    return $table->tutar;
                } else {
                    return 0;
                }
            })
            ->editColumn('islemTipi', function ($table) {
                if ($table->islemTipi == ISLEM_AVANS) {
                    return '<span style="color:#c56619">Avans</span>';
                } else {
                    return '<span style="color:#1168a6">Maaş</span>';
                }
            })
            ->editColumn('hesap', function ($table) {
                return Banka::getHesapName($table->hesap);

            })
            ->rawColumns(['edit', 'delete','islemTipi'])
            ->make(true);
        return $data;
    }
}
