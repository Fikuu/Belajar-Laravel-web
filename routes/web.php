<?php

use App\Http\Controllers\PenulisController;
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

Route::get('/', function () {
    return view('welcome');
});



//Menu
Route::post('/saveArtikel', [PenulisController::class, 'saveArtikel']);
Route::post('/saveKategori', [PenulisController::class, 'saveKategori']);

//Sub menu
Route::get('/tulis-artikel', [PenulisController::class, 'tulisArtikel']);
Route::get('/semua-artikel', [PenulisController::class, 'semuaArtikel']);
Route::get('/kategori', [PenulisController::class, 'kategoriArtikel']);
Route::get('/semua-kategori', [PenulisController::class, 'semuaKategori']);
Route::get('/publish', [PenulisController::class, 'publish']);
Route::get('/draft', [PenulisController::class, 'draft']);




//Artikel
Route::get('/tulis-artikel/getKategori/', [PenulisController::class, 'getKategori']);
Route::get('/semua-artikel/get', [PenulisController::class, 'semuaArtikel_get']);
Route::get('/semua-artikel/delete/{id}', [PenulisController::class, 'semuaArtikel_delete']);
Route::get('/semua-artikel/edit/{id}', [PenulisController::class, 'semuaArtikel_edit']);
Route::get('/semua-artikel/edit/get/{id}', [PenulisController::class, 'semuaArtikel_edit_get']);
Route::post('/editArtikel/submit', [PenulisController::class, 'editArtikelSubmit']);
Route::get('/publish/get', [PenulisController::class, 'allDataPublish']);
Route::get('/draft/get', [PenulisController::class, 'allDataDraft']);


//Kategori
Route::get('/semua-kategori/get/', [PenulisController::class, 'semuaKategori_get']);
Route::get('/semua-kategori/delete/{id}', [PenulisController::class, 'semuaKategori_detele']);
Route::get('/semua-kategori/edit/{id}', [PenulisController::class, 'semuaKategori_edit']);
Route::get('/semua-kategori/edit/get/{id}', [PenulisController::class, 'semuaKategori_edit_get']);

Route::post('/editKategori/submit', [PenulisController::class, 'editKategoriSubmit']);
