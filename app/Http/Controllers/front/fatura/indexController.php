<?php

namespace App\Http\Controllers\front\fatura;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Islem;
use App\Models\Logger;

use App\Models\Musteriler;
use App\Models\Urun;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{


    public function index()
    {
        return view('front.fis.index');

    }

    public function create($type)
    {
        if($type == 0){
            return view('front.fis.gelir.create');
        }
        else {
            return view('front.fis.gider.create');
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

                if($type == FATURA_GELIR){
                    Logger::Insert($all['faturaNo']." nolu Gelir Fişi Eklendi","Fiş");

                    if (count($islem) !=0) {
                        foreach ($islem as $k => $v) {
                            $islemArray = [
                                'faturaId' => $create->id,
                                'urunId' => $v['urun'],
                                'miktar' => $v['adet'],
                                'fiyat' => $v['tutar'],
                                'kdv' => $v['kdv'],
                                'araToplam' => $v['toplam_tutar'],
                                'kdvToplam' => $v['kdv_toplam'],
                                'genelToplam' => $v['genel_toplam'],
                                'text' => $v['text']


                            ];
                            FaturaIslem::create($islemArray);

                            if($v['urun'] != 0) {
                                $urunData = Urun::where('id', $v['urun'])->get();
                                $anlikStok = $urunData[0]['stok'];
                                $sonuc = $anlikStok - $v['adet'];
                                Urun::where('id',$v['urun'])->update(['stok' => $sonuc]);
                            }


                        }
                    }

                }
                else {
                    Logger::Insert($all['faturaNo'] . " nolu Gider Fişi Eklendi", "Fiş");

                    if (count($islem) != 0) {
                        foreach ($islem as $k => $v) {
                            $islemArray = [
                                'faturaId' => $create->id,
                                'miktar' => $v['adet'],
                                'fiyat' => $v['tutar'],
                                'kdv' => $v['kdv'],
                                'araToplam' => $v['toplam_tutar'],
                                'kdvToplam' => $v['kdv_toplam'],
                                'genelToplam' => $v['genel_toplam'],
                                'text' => $v['text']


                            ];
                            FaturaIslem::create($islemArray);
                        }
                    }
                }


                return redirect()->back()->with('status','Fiş Başarıyla Eklendi');
            }
            else {
                return redirect()->back()->with('statusDanger','Fiş Eklenemedi');
            }
        }
        else {
            return redirect()->back()->with('statusDanger','Fiş zaten mevcut.');
        }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Fatura::where('id', $id)->count();
            if ($c != 0) {
                $data = Fatura::where('id', $id)->get();
                $dataIslem = FaturaIslem::where('faturaId', $id)->get();

                if ($data[0]['faturaTipi'] == 0) {
                    //gelir
                    return view('front.fis.gelir.edit', ['data' => $data, 'dataIslem' => $dataIslem]);

                }
                return view('front.fis.gider.edit', ['data' => $data, 'dataIslem' => $dataIslem]);
            } else {
                return redirect('/');
            }
        }

    }

    public function update(Request $request)
    {
        $all = $request->except('_token');
        $id = $request->route('id');
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $islem = $all['islem'];
            unset($all['islem']);

            $data = Fatura::where('id',$id)->get();
            if($data[0]['faturaTipi'] == FATURA_GELIR){
                Logger::Insert($data[0]['faturaNo']." nolu Gelir Fişi Düzenlendi","Fiş");

                $dataFaturaIslem = FaturaIslem::where('faturaId',$data[0]['id'])->get();




                if (count($islem) !=0) {

                    foreach ($dataFaturaIslem as $k => $v) {
                        if($v['urunId'] != 0) {
                            $urundata = Urun::where('id',$v['urunId'])->get();
                            $stok = $v['miktar'] + $urundata[0]['stok'];
                            Urun::where('id',$v['urunId'])->update(['stok' => $stok]);
                        }
                    }

                    FaturaIslem::where('faturaId',$id)->delete();
                    foreach ($islem as $k => $v){
                        $islemArray = [
                            'faturaId' => $id,
                            'urunId' => $v['urun'],
                            'miktar' => $v['adet'],
                            'fiyat' => $v['tutar'],
                            'kdv' => $v['kdv'],
                            'araToplam' => $v['toplam_tutar'],
                            'kdvToplam' => $v['kdv_toplam'],
                            'genelToplam' => $v['genel_toplam'],
                            'text' => $v['text']
                        ];
                        if($v['urun'] != 0) {
                        $urundata = Urun::where('id',$v['urun'])->get();
                        $stok = $urundata[0]['stok'] - $v['adet'];
                        Urun::where('id',$v['urun'])->update(['stok' => $stok]);
                        }




                        FaturaIslem::create($islemArray);
                    }
                }
            }
            else {
                Logger::Insert($data[0]['faturaNo']." nolu Gider Fişi Düzenlendi","Fiş");

                if (count($islem) !=0) {
                    FaturaIslem::where('faturaId',$id)->delete();
                    foreach ($islem as $k => $v){
                        $islemArray = [
                            'faturaId' => $id,
                            'miktar' => $v['adet'],
                            'fiyat' => $v['tutar'],
                            'kdv' => $v['kdv'],
                            'araToplam' => $v['toplam_tutar'],
                            'kdvToplam' => $v['kdv_toplam'],
                            'genelToplam' => $v['genel_toplam'],
                            'text' => $v['text']
                        ];
                        FaturaIslem::create($islemArray);
                    }
                }
            }



            $update = Fatura::where('id', $id)->update($all);

            if ($update) {
                return redirect()->back()->with('status', 'Fiş Başarıyla Güncellendi');
            } else {
                return redirect()->back()->with('statusDanger', 'Fiş Güncellenemedi');
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

            $c = Fatura::where('id', $id)->count();
            $islemC = Islem::where('faturaId',$id)->count();
                if ($c != 0) {
                    $data = Fatura::where('id', $id)->get();

                    if($islemC != 0) {
                        Islem::where('faturaId',$id)->delete();

                    }
                    $dataFaturaIslem = FaturaIslem::where('faturaId',$id)->get();



                    foreach ($dataFaturaIslem as $k => $v) {
                        if($v['urunId'] != 0) {
                            $urundata = Urun::where('id',$v['urunId'])->get();
                            $stok = $v['miktar'] + $urundata[0]['stok'];
                            Urun::where('id',$v['urunId'])->update(['stok' => $stok]);
                        }
                    }

                    Logger::Insert($data[0]['faturaNo'] . " nolu Fiş Silindi", "Fiş");

                    Fatura::where('id', $id)->delete();
                    FaturaIslem::where('faturaId', $id)->delete();





                    return redirect()->back()->with('status', 'Fiş Başarıyla Silindi');
                } else {
                    return redirect('/')->with('statusDanger', 'Fiş Silinemedi');
                }

        }
    }

    public function detay($id){
        $c = Fatura::where('id',$id)->count();
        if($c!=0)
        {
            $data = FaturaIslem::where('faturaId',$id)->get();
            $faturaData = Fatura::where('id',$id)->get();


            return view('front.fis.detay',['data'=>$data,'faturaData'=>$faturaData]);
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Fatura::query();
        $data = DataTables::of($table)

            ->addColumn('edit', function ($table) {
                return '<a href="' . route('fis.edit', ['id' => $table->id]) . '"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon d-print-none"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a class="deleteButton" href="' . route('fis.delete', ['id' => $table->id]) . '"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon d-print-none"></i></a>';
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->addColumn('detay', function ($table) {
                return '<a href="' . route('fis.detay', ['id' => $table->id]) . '"><i title="Fiş Detayı" style="color:darkblue" class="feather feather-info list-icon d-print-none"></i></a>';
            })
            ->editColumn('faturaTipi', function ($table) {
                if ($table->faturaTipi == 0) {
                    return '<span style="color:#039f03">Gelir</span>';
                } else {
                    return '<span style="color:#c51919">Gider</span>';
                }
            })
            ->addColumn('toplamTutar', function ($table) {
                return Fatura::getTotal($table->id);
            })
            ->addColumn('kalanTutar', function ($table) {
                $getKalanTutar = Fatura::getKalanTutar($table->id);
                if ($getKalanTutar == 0) {
                    return '<i title="Ödendi" class="feather feather-check list-icon d-print-none"></i>';
                }
                else {
                    if($table->faturaTipi == FATURA_GELIR) {
                        return '<a style="color:#039f03" href="'.route('islem.create',['type'=>ISLEM_TAHSILAT, 'id' => $table->id]).'">'.$getKalanTutar.'</a>';
                    }
                    else{

                        return '<a style="color:#c51919" href="'.route('islem.create',['type'=>ISLEM_ODEME, 'id' => $table->id]).'">'.$getKalanTutar.'</a>';
                    }
                }
            })
            ->addColumn('gelir', function ($table){
                if ($table->faturaTipi == FATURA_GELIR) {
                    return Fatura::getTotal($table->id);
                } else {
                    return 0;
                }
            })
            ->addColumn('gider', function ($table){
                if ($table->faturaTipi == FATURA_GIDER) {
                    return Fatura::getTotal($table->id);
                } else {
                    return 0;
                }
            })
            ->addColumn('formatTarih', function ($table){
                return Fatura::getTarihFormatted($table->id);
            })
            ->addColumn('tarih', function ($table){
                return Fatura::getTarih($table->id);
            })
            ->addColumn('created', function ($table){
                $tarihFarki = Fatura::getCreated_at($table->id);
                if($tarihFarki < 0) {
                    return '<span style="color:#c51919">' .$tarihFarki*(-1).' gün önce</span>';
                }
                else if($tarihFarki == 0) {
                    return '<span style="color:#039f03">Aynı gün</span>';
                }
                else {
                    return '<span style="color:#c51919">'.$tarihFarki.' gün sonra</span>';
                }
            })
            ->rawColumns(['edit', 'delete','detay','kalanTutar','faturaTipi','created'])
            ->make(true);
        return $data;
    }


}


