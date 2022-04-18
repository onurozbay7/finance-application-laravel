<?php

namespace App\Http\Controllers\front\banka;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view('front.banka.index');

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
        $c = Banka::where('id', $id)->count();
        if ($c != 0) {
            $data = Banka::where('id', $id)->get();
            return view('front.banka.edit', ['data' => $data]);
        } else {
            return redirect('/');
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
        $c = Banka::where('id', $id)->count();
        if ($c != 0) {
            $data = Banka::where('id', $id)->get();
            Banka::where('id', $id)->delete();

            return redirect()->back()->with('status', 'Banka Başarıyla Silindi');
        } else {
            return redirect('/')->with('status', 'Banka Silinemedi');
        }
    }

    public function data(Request $request)
    {
        $table = Banka::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('banka.edit', ['id' => $table->id]) . '"><i class="feather feather-edit list-icon"></i></a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('banka.delete', ['id' => $table->id]) . '"><i class="feather feather-trash-2 list-icon"></i></a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }


}
