<?php

namespace App\Http\Controllers\front\musteriler;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Islem;
use App\Models\Logger;
use App\Models\Musteriler;
use App\Models\Rapor;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function __construct() {

    }

    public function index()
    {
        return view('front.musteriler.index');

    }

    public function create()
    {
        return view('front.musteriler.create');
    }

    public function store(Request $request)
    {

        $all = $request->except('_token');
        $all['photo'] = fileUpload::newUpload(rand(1,9000),'musteriler',$request->file('photo'),0);


            $create = Musteriler::create($all);



        if($create)
        {
            if($all['musteriTipi'] == 0){
                Logger::Insert($all['ad']." Müşterisi Eklendi","Müşteri");
            }
            else {
                Logger::Insert($all['firmaAdi']." Müşterisi Eklendi","Müşteri");
            }

            return redirect()->back()->with('status','Müşteri Ekleme İşlemi Başarılı');

        }
        else
        {
            return redirect()->back()->with('status','Müşteri Eklenemedi');

        }

    }

    public function edit($id)
    {
        if(!UserPermission::getMyControl(6)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Musteriler::where('id', $id)->count();
            if ($c != 0) {
                $data = Musteriler::where('id', $id)->get();
                return view('front.musteriler.edit', ['data' => $data]);
            } else {
                return redirect('/');
            }
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Musteriler::where('id',$id)->count();
        if($c !=0){
            $all = $request->except('_token');
            $data = Musteriler::where('id', $id)->get();
            $all['photo'] = fileUpload::changeUpload(rand(1,9000),"musteriler",$request->file('photo'),0,$data,'photo');

            $update = Musteriler::where('id',$id)->update($all);
            if($update)
            {
                Logger::Insert(Musteriler::getPublicName($id)." Müşterisi Düzenlendi","Müşteri");
                return redirect()->back()->with('status','Müşteri Başarıyla Güncellendi');
            }
            else {
                return redirect()->back()->with('status','Müşteri Güncellenemedi');
            }
        }
        else { return redirect('/');
        }
    }

    public function delete($id)
    {
        if(!UserPermission::getMyControl(7)) {
            Redirect::to('/')->with('statusDanger','Talep reddedildi. Erişim iznine sahip değilsiniz.')->send();
        }
        else {
            $c = Musteriler::where('id', $id)->count();
            $faturaC = Fatura::where('musteriId', $id)->count();
            if ($faturaC != 0) {
                return redirect()->back()->with('statusDanger', 'Müşterinin fişleri mevcut. Lütfen önce fişleri silin.');
            } else {
                if ($c != 0) {
                    $data = Musteriler::where('id', $id)->get();
                    Logger::Insert(Musteriler::getPublicName($data[0]['id']) . " Müşterisi Silindi", "Müşteri");
                    fileUpload::deleteDirectory($data[0]['photo']);
                    Musteriler::where('id', $id)->delete();

                    return redirect()->back()->with('status', 'Müşteri Başarıyla Silindi');
                } else {
                    return redirect('/')->with('status', 'Müşteri Silinemedi');
                }
            }
        }
        }


    public function data(Request $request){
        $table =Musteriler::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('musteriler.edit',['id'=>$table->id]).'"><i title="Düzenle" style="color:darkgreen" class="feather feather-edit list-icon d-print-none"></i></a>';
            })
            ->addColumn('delete',function ($table){
                return '<a class="deleteButton" href="'.route('musteriler.delete',['id'=>$table->id]).'"><i title="Sil" style="color:darkred" class="feather feather-trash-2 list-icon d-print-none"></i></a>';
            })
            ->addColumn('publicname', function ($table){
                if($table->musteriTipi == 0){
                    return $table->ad." ".$table->soyad;
                }
                else {
                    return $table->firmaAdi;
                }
            })
            ->editColumn('musteriTipi', function ($table){
                if($table->musteriTipi ==0){
                    return "Bireysel";
                }
                else{ return "Kurumsal"; }
            })
            ->addColumn('bakiye',function ($table){

                $bakiye = Rapor::getMusteriBakiye($table->id);
                if($bakiye < 0)
                {
                    return '<a href="'.route('islem.create',['type'=>1]).'" style="color:#c51919">'.$bakiye*(-1).' Borçlu</a>';
                }
                elseif($bakiye > 0){
                    return '<a href="'.route('islem.create',['type'=>0]).'" style="color:#039f03">'.$bakiye.' Alacaklı</a>';
                }
                else
                {
                    return '<i title="Borcu/Alacağı Yok" class="feather feather-check list-icon d-print-none"></i>';
                }
                return 0;
            })
            ->addColumn('cari',function ($table){
                return '<a href="'.route('musteriler.cari',['id'=>$table->id]).'"><i title="Müşteri Cari Hareketleri" style="color:darkblue" class="feather feather-file list-icon d-print-none"></i></a>';
            })
            ->rawColumns(['edit','delete','bakiye','cari'])
            ->make(true);
        return $data;
    }

    public function cari($id){
        $c = Musteriler::where('id',$id)->count();
        if($c!=0)
        {
            $data = Musteriler::where('id',$id)->get();


            $faturaTablo = FaturaIslem::leftJoin('faturas','fatura_islems.faturaId','=','faturas.id')
                ->where('faturas.musteriId',$id)
                ->groupBy('faturas.id')
                ->orderBy('faturas.faturaTarih','desc')
                ->select(['faturas.id as id','faturas.faturaTipi as type',DB::raw('"fatura" as uType'),DB::raw('SUM(genelToplam) as fiyat'),'faturas.faturaTarih as tarih']);


            $islemTablo = Islem::where('musteriId',$id)
                ->orderBy('tarih','desc')
                ->select(['id','tip as type',DB::raw('"islem" as uType'),'fiyat','tarih']);



            $viewData = $faturaTablo->union($islemTablo)
                ->orderBy('tarih','asc')
                ->get();


            return view('front.musteriler.cari',['data'=>$data,'viewData'=>$viewData]);
        }
        else
        {
            return redirect('/');
        }
    }

}
