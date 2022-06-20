<?php

namespace App\Http\Controllers\front\islem;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Islem;
use App\Models\Logger;
use App\Models\Musteriler;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index(){
        return view('front.islem.index');
    }

    public function create($type) {

        if($type == 0) {
            // ödeme
            return view('front.islem.odeme.create')->with('faturaId');
        }
        else {
            // tahsilat
            return view('front.islem.tahsilat.create');
        }
    }

    public function store(Request $request){
        $all = $request->except('_token');
        $type = $request->route('type');
        $all['tip'] = $type;

        $faturaId = $request->input('faturaId');
        $anlikFiyat = $request->input('fiyat');
        $faturaFiyat = FaturaIslem::where('faturaId',$faturaId)->sum('genelToplam');
        $islemC = Islem::where('faturaId',$faturaId)->count();
        $banka = Banka::where('id',$all['hesap'])->get();
        $isTrue = false;
        if($islemC != 0) {
            $islemFiyat = Islem::where('faturaId',$faturaId)->sum('fiyat');
        }
        else {
            $islemFiyat = 0;
        }

        if($islemFiyat + $anlikFiyat > $faturaFiyat) {
            return redirect()->back()->with('statusDanger','İşlem tutarı Fiş tutarından büyük olamaz. Lütfen fiyatı ve Fişe ait önceki işlemleri kontrol edin. Fişe ait kalan tutar: '. Fatura::getKalanTutar($faturaId));
        }

        else {


        $bakiye = $banka[0]['bakiye'];


            if($type == ISLEM_ODEME){ $bakiye = $bakiye - $all['fiyat']; }
            else { $bakiye = $bakiye + $all['fiyat']; }

            if($bakiye>=0) {
                Banka::where('id',$all['hesap'])->update(['bakiye' => $bakiye]);
                $create = Islem::create($all);
                if($create) {
                    if($type == ISLEM_ODEME){
                        Logger::Insert(Fatura::getNo($faturaId). " fişine ait ". $all['fiyat']. "TL Ödeme Yapıldı","İşlem");
                    }
                    else {
                        Logger::Insert(Fatura::getNo($faturaId). " fişine ait ". $all['fiyat']. " TL Tahsilat Yapıldı","İşlem");
                    }
                    return redirect()->back()->with('status','İşlem Başarıyla Eklendi');
                }
                else {
                    return redirect()->back()->with('statusDanger','İşlem Eklenemedi');
                }
            }
            else {
                return redirect()->back()->with('statusDanger', 'Banka bakiyesi yetersiz');
            }




        }

    }

    public function edit($id) {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Islem::where('id', $id)->count();

            if ($c != 0) {
                $w = Islem::where('id', $id)->get();
                if ($w[0]['tip'] == 0) {
                    return view('front.islem.odeme.edit', ['data' => $w]);
                } else {
                    return view('front.islem.tahsilat.edit', ['data' => $w]);
                }
            } else {
                return redirect('/')->with('statusDanger', 'İşlem Düzenlenemedi');
            }
        }
    }

    public function update(Request $request) {
        $id = $request->route('id');
        $all = $request->except('_token');


        $faturaId = $request->input('faturaId');
        $anlikFiyat = $request->input('fiyat');
        $faturaFiyat = FaturaIslem::where('faturaId',$faturaId)->sum('genelToplam');
        $islemC = Islem::where('faturaId',$faturaId)->count();
        $c = Islem::where('id',$id)->count();
        if ($c != 0){
            $islem = Islem::where('id', $id)->get();
            $banka = Banka::where('id',$islem[0]['hesap'])->get();
            $islemTipi = $islem[0]['tip'];


            $yeniBanka = Banka::where('id',$all['hesap'])->get();
            $bakiye = $banka[0]['bakiye'];
            $yeniBankaBakiye = $yeniBanka[0]['bakiye'];

            $isTrue = false;
            $islemFiyat = $islem[0]['fiyat'];

                if($islem[0]['hesap'] != $all['hesap']) {
                    if($islemTipi == ISLEM_ODEME){
                        $bakiye = $bakiye + $islem[0]['fiyat'];
                        $yeniBankaBakiye = $yeniBankaBakiye - $all['fiyat'];
                    }
                    else {
                        $bakiye = $bakiye - $islem[0]['fiyat'];
                        $yeniBankaBakiye = $yeniBankaBakiye + $all['fiyat'];
                    }

                    if($yeniBankaBakiye >= 0){$isTrue = true;}
                    else {$isTrue = false;}
                }
                else if($islem[0]['fiyat'] != $all['fiyat']){
                    if($islemTipi == ISLEM_ODEME){
                        $bakiye = $bakiye + $islem[0]['fiyat'];
                        $bakiye = $bakiye - $all['fiyat'];
                    }
                    else {
                        $bakiye = $bakiye - $islem[0]['fiyat'];
                        $bakiye = $bakiye + $all['fiyat'];
                    }

                    if($bakiye >= 0) {$isTrue = true;}
                    else {$isTrue = false;}

                }
                else {$isTrue = true;}

            if($isTrue == true) {



            if($islemC != 0) {
                $islemToplamFiyat = Islem::where('faturaId',$faturaId)->sum('fiyat') - $islemFiyat;
            }
            else {
                $islemToplamFiyat = 0;
            }

            if($islemToplamFiyat + $anlikFiyat > $faturaFiyat) {
                return redirect()->back()->with('statusDanger','İşlem tutarı Fiş tutarından büyük olamaz. Lütfen fiyatı ve Fişe ait önceki işlemleri kontrol edin. Fişe ait kalan tutar: '. Fatura::getKalanTutar($faturaId));
            }

            else {
                if($islem[0]['hesap'] != $all['hesap']) {
                    Banka::where('id',$islem[0]['hesap'])->update(['bakiye' => $bakiye]);
                    Banka::where('id',$all['hesap'])->update(['bakiye' => $yeniBankaBakiye]);
                }

                else if($islem[0]['fiyat'] != $all['fiyat']){
                    Banka::where('id',$islem[0]['hesap'])->update(['bakiye' => $bakiye]);
                }
                Islem::where('id', $id)->update($all);
                $data = Islem::where('id', $id)->get();

                if ($data[0]['tip'] == ISLEM_ODEME) {
                    Logger::Insert(Fatura::getNo($data[0]['faturaId']) . " nolu fişe ait Ödeme Düzenlendi", "İşlem");
                } else {
                    Logger::Insert(Fatura::getNo($data[0]['faturaId']) . " nolu fişe ait Tahsilat Düzenlendi", "İşlem");
                }

                return redirect()->back()->with('status', 'İşlem Başarıyla Güncellendi');
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

    public function delete($id){
        if(!UserPermission::getMyControl(7)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Islem::where('id', $id)->count();
            if ($c != 0) {

                $data = Islem::where('id', $id)->get();
                $banka = Banka::where('id',$data[0]['hesap'])->get();
                if($data[0]['tip'] == ISLEM_ODEME) {
                    $bakiye = $banka[0]['bakiye'] + $data[0]['fiyat'];

                }
                else {
                    $bakiye = $banka[0]['bakiye'] - $data[0]['fiyat'];
                }

                Banka::where('id',$data[0]['hesap'])->update(['bakiye' => $bakiye]);



                Islem::where('id', $id)->delete();
                if ($data[0]['tip'] == ISLEM_ODEME) {
                    Logger::Insert(Fatura::getNo($data[0]['faturaId']) . " nolu fişe ait Ödeme Silindi", "İşlem");
                } else {
                    Logger::Insert(Fatura::getNo($data[0]['faturaId']) . " nolu fişe ait Tahsilat Silindi", "İşlem");
                }
                return redirect()->back()->with('status', 'İşlem Başarıyla Silindi');
            }
            else {
                return redirect('/');
            }
        }
    }

    public function data(Request $request)
    {
        $table = Islem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('islem.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('islem.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->addColumn('faturaNo', function ($table){
                return Fatura::getNo($table->faturaId);
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->addColumn('tarih', function ($table){
                return \Carbon\Carbon::parse($table->tarih);
            })
            ->addColumn('formatTarih', function ($table){
                return \Carbon\Carbon::parse($table->tarih)->format('d/m/Y');
            })
            ->addColumn('hesap', function ($table){
                return Banka::getHesapName($table->hesap);
            })
            ->addColumn('aciklama', function ($table){
                return $table->text;
            })

            ->addColumn('tahsilat', function ($table){
                if ($table->tip == ISLEM_TAHSILAT) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('odeme', function ($table){
                if ($table->tip == ISLEM_ODEME) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('tahsilatNakit', function ($table){
                if ($table->odemeSekli == ODEME_NAKIT && $table->tip == ISLEM_TAHSILAT) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('odemeNakit', function ($table){
                if ($table->odemeSekli == ODEME_NAKIT && $table->tip == ISLEM_ODEME) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('tahsilatBanka', function ($table){
                if ($table->odemeSekli == ODEME_BANKA && $table->tip == ISLEM_TAHSILAT) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('odemeBanka', function ($table){
                if ($table->odemeSekli == ODEME_BANKA && $table->tip == ISLEM_ODEME) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('tahsilatKredi', function ($table){
                if ($table->odemeSekli == ODEME_KREDİ && $table->tip == ISLEM_TAHSILAT) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('odemeKredi', function ($table){
                if ($table->odemeSekli == ODEME_KREDİ && $table->tip == ISLEM_ODEME) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('tahsilatCek', function ($table){
                if ($table->odemeSekli == ODEME_CEKSENET && $table->tip == ISLEM_TAHSILAT) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('odemeCek', function ($table){
                if ($table->odemeSekli == ODEME_CEKSENET && $table->tip == ISLEM_ODEME) {
                    return $table->fiyat;
                } else {
                    return 0;
                }
            })
            ->addColumn('created', function ($table){
                $tarihFark = Islem::getCreated_at($table->id);
                if($tarihFark < 0) {
                    return '<span style="color:#c51919">' .$tarihFark*(-1).' gün önce</span>';
                }
                else if($tarihFark == 0) {
                    return '<span style="color:#039f03">Aynı gün</span>';
                }
                else {
                    return '<span style="color:#c51919">'.$tarihFark.' gün sonra</span>';
                }
            })
            ->editColumn('tip', function ($table) {
                if ($table->tip == 0) {
                    return '<span style="color:#c51919">Ödeme</span>';
                } else {
                    return '<span style="color:#039f03">Tahsilat</span>';
                }
            })
            ->editColumn('odemeSekli', function ($table) {
                if ($table->odemeSekli == 0) {
                    return '<span style="color:#039f03">.Nakit</span>';
                } else if($table->odemeSekli == 1){
                    return '<span style="color:#033a9f">Banka(EFT/Havale)</span>';
                }
                else if($table->odemeSekli == 2){
                    return '<span style="color:#b45504">Kredi Kartı</span>';
                }
                else if($table->odemeSekli == 3){
                    return '<span style="color:#9f0303">ÇEK/Senet</span>';
                }
            })
            ->rawColumns(['edit', 'delete','created','info','tip','odemeSekli'])
            ->make(true);
        return $data;
    }
}
