<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace'=>'front','middleware'=>['auth']],function (){

    Route::group(['namespace'=>'profil','as'=>'profil.', 'prefix'=>'profil'], function (){

        Route::get('/',[App\Http\Controllers\front\profil\indexController::class, 'index'])->name('index');
        Route::post('/',[App\Http\Controllers\front\profil\indexController::class, 'update'])->name('update');

    });

    Route::group(['namespace'=>'logger','as'=>'logger.', 'prefix'=>'logger'], function (){

        Route::get('/',[App\Http\Controllers\front\logger\indexController::class, 'index'])->name('index');
        Route::post('/data', [App\Http\Controllers\front\logger\indexController::class, 'data'])->name('data');

    });

    Route::group(['namespace'=>'home', 'as'=>'home.'],function (){

        Route::get('/',[App\Http\Controllers\front\home\indexController::class, 'index'])->name('index');

    });

    Route::group(['namespace'=>'musteriler','as'=>'musteriler.', 'prefix'=>'musteriler', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\musteriler\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'delete'])->name('delete');
        Route::get('/cari/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'cari'])->name('cari');
        Route::post('/data', [App\Http\Controllers\front\musteriler\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'fis','as'=>'fis.', 'prefix'=>'fis', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\fatura\indexController::class, 'index'])->name('index');
        Route::get('/olustur/{type}',[App\Http\Controllers\front\fatura\indexController::class, 'create'])->name('create');
        Route::post('/olustur/{type}',[App\Http\Controllers\front\fatura\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'delete'])->name('delete');
        Route::get('/detay/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'detay'])->name('detay');
        Route::post('/data', [App\Http\Controllers\front\fatura\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'banka','as'=>'banka.', 'prefix'=>'banka', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\banka\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\banka\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\banka\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\banka\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\banka\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\banka\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\banka\indexController::class, 'data'])->name('data');
        Route::get('/transfer', [App\Http\Controllers\front\banka\indexController::class, 'transfer'])->name('transfer');
        Route::post('/transfer', [App\Http\Controllers\front\banka\indexController::class, 'transferYap'])->name('transferYap');
    });

    Route::group(['namespace'=>'islem','as'=>'islem.', 'prefix'=>'islem', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\islem\indexController::class, 'index'])->name('index');
        Route::get('/olustur/{type}/{id?}',[App\Http\Controllers\front\islem\indexController::class, 'create'])->name('create');
        Route::post('/olustur/{type}',[App\Http\Controllers\front\islem\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\islem\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\islem\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\islem\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\islem\indexController::class, 'data'])->name('data');
    });


    Route::group(['namespace'=>'kapi','as'=>'kapi.', 'prefix'=>'kapi', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\kapi\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\kapi\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\kapi\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\kapi\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\kapi\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\kapi\indexController::class, 'delete'])->name('delete');
        Route::get('/detay/{id}',[App\Http\Controllers\front\kapi\indexController::class, 'detay'])->name('detay');
        Route::post('/data', [App\Http\Controllers\front\kapi\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'kapak','as'=>'kapak.', 'prefix'=>'kapak', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\kapak\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\kapak\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\kapak\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\kapak\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\kapak\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\kapak\indexController::class, 'delete'])->name('delete');
        Route::get('/detay/{id}',[App\Http\Controllers\front\kapak\indexController::class, 'detay'])->name('detay');
        Route::post('/data', [App\Http\Controllers\front\kapak\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'urun','as'=>'urun.', 'prefix'=>'urun', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\urun\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\urun\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\urun\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\urun\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\urun\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\urun\indexController::class, 'delete'])->name('delete');
        Route::post('/stokEkle/{id}',[App\Http\Controllers\front\urun\indexController::class, 'stokEkle'])->name('stokEkle');
        Route::post('/data', [App\Http\Controllers\front\urun\indexController::class, 'data'])->name('data');
    });


    Route::group(['namespace'=>'user','as'=>'user.', 'prefix'=>'user', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\user\indexController::class, 'index'])->name('index');
        Route::get('/olustur/',[App\Http\Controllers\front\user\indexController::class, 'create'])->name('create');
        Route::post('/olustur/',[App\Http\Controllers\front\user\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\user\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\user\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\user\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\user\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'personel','as'=>'personel.', 'prefix'=>'personel', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\personel\indexController::class, 'index'])->name('index');
        Route::get('/olustur/',[App\Http\Controllers\front\personel\indexController::class, 'create'])->name('create');
        Route::post('/olustur/',[App\Http\Controllers\front\personel\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\personel\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\personel\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\personel\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\personel\indexController::class, 'data'])->name('data');
    });
    Route::group(['namespace'=>'personelIslem','as'=>'personelIslem.', 'prefix'=>'personelIslem', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\personelIslem\indexController::class, 'index'])->name('index');
        Route::get('/olustur/',[App\Http\Controllers\front\personelIslem\indexController::class, 'create'])->name('create');
        Route::post('/olustur/',[App\Http\Controllers\front\personelIslem\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\personelIslem\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\personelIslem\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\personelIslem\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\personelIslem\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'notlar','as'=>'notlar.', 'prefix'=>'notlar', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\notlar\indexController::class, 'index'])->name('index');
        Route::get('/olustur/',[App\Http\Controllers\front\notlar\indexController::class, 'create'])->name('create');
        Route::post('/olustur/',[App\Http\Controllers\front\notlar\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\notlar\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\notlar\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\notlar\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\notlar\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'takvim','as'=>'takvim.', 'prefix'=>'takvim', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\takvim\indexController::class, 'index'])->name('index');
        Route::post('/action', [App\Http\Controllers\front\takvim\indexController::class, 'action'])->name('action');
    });



});
