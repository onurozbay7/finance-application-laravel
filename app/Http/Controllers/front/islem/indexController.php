<?php

namespace App\Http\Controllers\front\islem;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\Islem;
use App\Models\Musteriler;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index(){
        return view('front.islem.index');
    }

    public function create($type) {
        if($type == 0) {
            // ödeme
            return view('front.islem.odeme.create');
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
        $create = Islem::create($all);
        if($create) {
            return redirect()->back()->with('status','İşlem Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('statusDanger','İşlem Eklenemedi');
        }
    }

    public function edit($id) {
        $c = Islem::where('id',$id)->count();

        if($c != 0){
           $w = Islem::where('id',$id)->get();
           if($w[0]['tip']==0){
               return view('front.islem.odeme.edit',['data'=>$w]);
           }
           else {
               return view('front.islem.tahsilat.edit',['data'=>$w]);
           }
        }

        else {
            return redirect('/')->with('statusDanger','İşlem Düzenlenemedi');
        }
    }

    public function update(Request $request) {
        $id = $request->route('id');
        $all = $request->except('_token');
        $c = Islem::where('id',$id)->count();
        if ($c != 0){
            Islem::where('id',$id)->update($all);
            return redirect()->back()->with('status','İşlem Başarıyla Güncellendi');
        }
        else {
            return redirect('/');
        }
    }

    public function delete($id){
        $c = Islem::where('id',$id)->count();
        if($c != 0){
            Islem::where('id',$id)->delete();
            return redirect()->back()->with('status','İşlem Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Islem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('islem.edit', ['id' => $table->id]) . '"><i class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('islem.delete', ['id' => $table->id]) . '"><i class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->addColumn('faturaNo', function ($table){
                return Fatura::getNo($table->faturaId);
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->editColumn('tip', function ($table) {
                if ($table->tip == 0) {
                    return "Ödeme";
                } else {
                    return "Tahsilat";
                }
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }
}
