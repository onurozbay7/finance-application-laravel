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

    Route::group(['namespace'=>'home', 'as'=>'home.'],function (){

        Route::get('/',[App\Http\Controllers\front\home\indexController::class, 'index'])->name('index');
    });

    Route::group(['namespace'=>'musteriler','as'=>'musteriler.', 'prefix'=>'musteriler'], function (){

        Route::get('/', [App\Http\Controllers\front\musteriler\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\musteriler\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'kalem','as'=>'kalem.', 'prefix'=>'kalem'], function (){

        Route::get('/', [App\Http\Controllers\front\kalem\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\kalem\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\kalem\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\kalem\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\kalem\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\kalem\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\kalem\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'fatura','as'=>'fatura.', 'prefix'=>'fatura'], function (){

        Route::get('/', [App\Http\Controllers\front\fatura\indexController::class, 'index'])->name('index');
        Route::get('/olustur/{type}',[App\Http\Controllers\front\fatura\indexController::class, 'create'])->name('create');
        Route::post('/olustur/{type}',[App\Http\Controllers\front\fatura\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\fatura\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\fatura\indexController::class, 'data'])->name('data');
    });

    Route::group(['namespace'=>'banka','as'=>'banka.', 'prefix'=>'banka'], function (){

        Route::get('/', [App\Http\Controllers\front\banka\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\banka\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\banka\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\banka\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\banka\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\banka\indexController::class, 'delete'])->name('delete');
        Route::post('/data', [App\Http\Controllers\front\banka\indexController::class, 'data'])->name('data');
    });

});
