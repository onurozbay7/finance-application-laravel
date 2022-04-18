<?php

namespace App\Http\Controllers\front\kalem;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\Kalem;
use App\Models\Musteriler;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.kalem.index');

    }

    public function create()
    {
        return view('front.kalem.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');

        $create = Kalem::create($all);
        if($create)
        {
            return redirect()->back()->with('status','Kalem Ekleme İşlemi Başarılı');

        }
        else
        {
            return redirect()->back()->with('status','Kalem Eklenemedi');

        }

    }

    public function edit($id)
    {
        $c = Kalem::where('id',$id)->count();
        if($c !=0){
            $data = Kalem::where('id',$id)->get();
            return view('front.kalem.edit',['data'=>$data]);
        }
        else {
            return redirect('/');
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Kalem::where('id',$id)->count();
        if($c !=0){
            $all = $request->except('_token');
            $data = Kalem::where('id', $id)->get();


            $update = Kalem::where('id',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Kalem Başarıyla Güncellendi');
            }
            else {
                return redirect()->back()->with('status','Kalem Güncellenemedi');
            }
        }
        else { return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = Kalem::where('id',$id)->count();
        if($c !=0){
            $data = Kalem::where('id',$id)->get();
            Kalem::where('id',$id)->delete();

            return redirect()->back()->with('status','Kalem Başarıyla Silindi');
        }
        else {
            return redirect('/')->with('status','Kalem Silinemedi');
        }
    }

    public function data(Request $request){
        $table =Kalem::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('kalem.edit',['id'=>$table->id]).'"><i class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('kalem.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->editColumn('kalemTipi', function ($table){
                if($table->kalemTipi ==0){
                    return "Gelir";
                }
                else{ return "Gider"; }
            })
            ->addColumn('kdv', function ($table){
                return Kalem::getKdv($table->id);
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }
}
