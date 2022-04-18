<?php

namespace App\Http\Controllers\front\musteriler;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\Musteriler;
use App\Models\Rapor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
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
            return redirect()->back()->with('status','Müşteri Ekleme İşlemi Başarılı');

        }
        else
        {
            return redirect()->back()->with('status','Müşteri Eklenemedi');

        }

    }

    public function edit($id)
    {
        $c = Musteriler::where('id',$id)->count();
        if($c !=0){
            $data = Musteriler::where('id',$id)->get();
            return view('front.musteriler.edit',['data'=>$data]);
        }
        else {
            return redirect('/');
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
        $c = Musteriler::where('id',$id)->count();
        $faturaC = Fatura::where('musteriId', $id)->count();
        if($faturaC != 0){
            return redirect()->back()->with('statusDanger','Müşterinin faturaları mevcut. Lütfen önce faturaları silin.');
        }
        else {
            if($c !=0){
                $data = Musteriler::where('id',$id)->get();
                fileUpload::deleteDirectory($data[0]['photo']);
                Musteriler::where('id',$id)->delete();

                return redirect()->back()->with('status','Müşteri Başarıyla Silindi');
            }
            else {
                return redirect('/')->with('status','Müşteri Silinemedi');
            }
        }
        }


    public function data(Request $request){
        $table =Musteriler::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('musteriler.edit',['id'=>$table->id]).'"><i class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('musteriler.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->addColumn('publicname', function ($table){
                return Musteriler::getPublicName($table->id);
            })
            ->editColumn('musteriTipi', function ($table){
                if($table->musteriTipi ==0){
                    return "Bireysel";
                }
                else{ return "Kurumsal"; }
            })
            ->addColumn('telefon', function ($table){
                return Musteriler::getPhoneNumber($table->id);
            })
            ->addColumn('email', function ($table){
                return Musteriler::getEmail($table->id);
            })
            ->addColumn('adres', function ($table){
                return Musteriler::getAdress($table->id);
            })
            ->addColumn('bakiye',function ($table){

                $bakiye = Rapor::getMusteriBakiye($table->id);
                if($bakiye < 0)
                {
                    return '<span style="color:red">'.$bakiye.'</span>';
                }
                elseif($bakiye > 0){
                    return '<span style="color:green">+'.$bakiye.'</span>';
                }
                else
                {
                    return $bakiye;
                }
            })
            ->rawColumns(['edit','delete','bakiye'])
            ->make(true);
        return $data;
    }
}
