<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PosjagaController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TukarjagaController;
use App\Http\Controllers\AdduserController;
use App\Http\Controllers\KejadianController;


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
    return view('auth.login');
});

Auth::routes();

// Personil section
Route::get('/edit-personil', function () {
    return view('personil.edit');
})->middleware('auth')->name('edit-personil');

Route::post('/personil/simpan',[HomeController::class, 'simpan'])->middleware('auth')->name('simpan_personil');
Route::put('/personil-update/{id}',[HomeController::class, 'update'])->middleware('auth');
Route::get('/personil', [HomeController::class, 'index'])->middleware('auth')->name('personil');
Route::get('/tambah-personil', [HomeController::class, 'showInput'])->middleware('auth')->name('tambah-personil');
Route::get('/personil/{id}', [HomeController::class, 'detil'])->middleware('auth'); 
Route::get('/edit-personil/{id}', [HomeController::class, 'edit'])->middleware('auth'); 
Route::delete('/hapus-personil/{id}', [HomeController::class, 'hapus'])->middleware('auth');
Route::get('/hapus-fopro/{id}', [HomeController::class, 'hapusProfil'])->middleware('auth');
Route::get('/hapus-kta/{id}', [HomeController::class, 'hapusKta'])->middleware('auth');
Route::get('/hapus-bpjss/{id}', [HomeController::class, 'hapusBpjss'])->middleware('auth');
Route::get('/hapus-bpjsk/{id}', [HomeController::class, 'hapusBpjsk'])->middleware('auth');

// Peralatan section
Route::get('/edit-peralatan', function () {
    return view('peralatan.edit');
})->middleware('auth')->name('edit-peralatan');
Route::post('/peralatan/simpan',[PeralatanController::class, 'simpan'])->middleware('auth')->name('simpan_peralatan');
Route::put('/peralatan-update/{id}',[PeralatanController::class, 'update'])->middleware('auth');
Route::get('/tambah-peralatan', [PeralatanController::class, 'showInput'])->middleware('auth')->name('tambah-peralatan');
Route::get('/peralatan', [PeralatanController::class, 'index'])->middleware('auth')->name('peralatan');
Route::get('/edit-peralatan/{id}', [PeralatanController::class, 'edit'])->middleware('auth'); 
Route::delete('/hapus-alat/{id}', [PeralatanController::class, 'hapus'])->middleware('auth');

// Site section
Route::get('/tambah-site', function () {
    return view('site.input');
})->middleware('auth')->name('tambah-site');
Route::get('/edit-site', function () {
    return view('site.edit');
})->middleware('auth')->name('edit-site');
Route::post('/site/simpan',[SiteController::class, 'simpan'])->middleware('auth')->name('simpan_site');
Route::put('/site-update/{id}',[SiteController::class, 'update'])->middleware('auth');
Route::get('/site', [SiteController::class, 'index'])->middleware('auth')->name('site');
Route::get('/edit-site/{id}', [SiteController::class, 'edit'])->middleware('auth');
Route::delete('/hapus-site/{id}', [SiteController::class, 'hapus'])->middleware('auth');

// Pos Jaga Section
Route::get('/tambah-pos', function () {
    return view('posjaga.input');
})->middleware('auth')->name('tambah-pos');
Route::get('/edit-pos', function () {
    return view('posjaga.edit');
})->middleware('auth')->name('edit-pos');
Route::get('/posjaga', [PosjagaController::class, 'index'])->middleware('auth')->name('posjaga');
Route::put('/pos-update/{id}',[PosjagaController::class, 'update'])->middleware('auth');
Route::get('/hapus-foto/{id}', [PosjagaController::class, 'hapusFoto'])->middleware('auth');
Route::get('/edit-pos/{id}', [PosjagaController::class, 'edit'])->middleware('auth');
Route::delete('/hapus-pos/{id}', [PosjagaController::class, 'hapus'])->middleware('auth');

//Lot Parkir Section
Route::get('/tambah-lot', function () {
    return view('parkir.input');
})->middleware('auth')->name('tambah-lot');
Route::get('/parkir', [ParkirController::class, 'index'])->middleware('auth')->name('parkir');
Route::post('/simpan-lot', [ParkirController::class, 'simpan'])->middleware('auth')->name('simpan_lot');
Route::put('/parkir-update/{id}',[ParkirController::class, 'update'])->middleware('auth');
Route::get('/edit-lot/{id}', [ParkirController::class, 'edit'])->middleware('auth');
Route::delete('/hapus-lot/{id}', [ParkirController::class, 'hapus'])->middleware('auth');

//Arsip Section
Route::get('/arsip', [ArsipController::class, 'index'])->middleware('auth')->name('arsip');
Route::get('/tambah-arsip', [ArsipController::class, 'gen'])->middleware('auth')->name('tambah-arsip');
Route::post('/simpan-arsip', [ArsipController::class, 'simpan'])->middleware('auth')->name('simpan_arsip');
Route::delete('/hapus-arsip/{id}', [ArsipController::class, 'hapus'])->middleware('auth');
Route::get('/arsip/file/{id}', [ArsipController::class, 'hapusFile'])->middleware('auth');
Route::get('/edit-arsip/{id}', [ArsipController::class, 'edit'])->middleware('auth');
Route::put('/arsip-update/{id}',[ArsipController::class, 'update'])->middleware('auth');


//Kegiatan Section
Route::get('/kegiatan', [kegiatanController::class, 'index'])->middleware('auth')->name('kegiatan');
Route::get('/tambah-giat', [kegiatanController::class, 'tambah'])->middleware('auth')->name('tambah-giat');
Route::post('/simpan-giat', [kegiatanController::class, 'simpan'])->middleware('auth')->name('simpan_giat');
Route::get('/giat-detil/{id}', [kegiatanController::class, 'detil'])->middleware('auth'); 
Route::get('/edit-giat/{id}', [kegiatanController::class, 'edit'])->middleware('auth');
Route::put('/update-giat/{id}',[kegiatanController::class, 'update'])->middleware('auth');
Route::delete('/hapus-giat/{id}', [kegiatanController::class, 'hapus'])->middleware('auth');
Route::get('/giat/hapus-foto/{item}/{id}', [kegiatanController::class, 'hapusFoto'])->middleware('auth');

//Tukarjaga Section
Route::get('/tukarjaga', [TukarjagaController::class, 'index'])->middleware('auth')->name('tukarjaga');
Route::get('/tukar-tambah', [TukarjagaController::class, 'input'])->middleware('auth')->name('tukar-tambah');
Route::post('/simpan-tukar', [TukarjagaController::class, 'simpan'])->middleware('auth')->name('simpan_tukar');
Route::get('/trj-detil/{no_trj}/{id}', [TukarjagaController::class, 'detil'])->middleware('auth'); 
Route::delete('/hapus-jaga/{id}', [TukarjagaController::class, 'hapus'])->middleware('auth');
Route::get('/edit-lap/{id}', [TukarjagaController::class, 'edit'])->middleware('auth');

//Delete area
Route::get('/hapus-shiftlama/{item}/{trj}', [TukarjagaController::class, 'hapuslama'])->middleware('auth');
Route::get('/hapus-shiftbaru/{item}/{trj}', [TukarjagaController::class, 'hapusbaru'])->middleware('auth');
Route::delete('/hapus-tukarbarang/{trj}/{id}', [TukarjagaController::class, 'hapusbarang'])->middleware('auth');
Route::delete('/hapus-tukargiat/{trj}/{id}', [TukarjagaController::class, 'hapusgiat'])->middleware('auth');
//edit area
Route::put('/update-inv/{trj}/{id}',[TukarjagaController::class, 'editinv'])->middleware('auth');
Route::put('/update-giat/{trj}/{id}',[TukarjagaController::class, 'editgiat'])->middleware('auth');
Route::put('/edt-shift/{trj}/{id}',[TukarjagaController::class, 'editshift'])->middleware('auth');
//add area
Route::post('/add-inv/{trj}', [TukarjagaController::class, 'simpaninv'])->middleware('auth');
Route::post('/add-giat/{trj}', [TukarjagaController::class, 'simpangiat'])->middleware('auth');
Route::put('/add-shiftl/{trj}/{id}',[TukarjagaController::class, 'addshiftlama'])->middleware('auth');
Route::put('/add-shiftb/{trj}/{id}',[TukarjagaController::class, 'addshiftbaru'])->middleware('auth');

// Dokument Section
Route::get('/viewpdf/{id}', [TukarjagaController::class, 'generatePDF']);
Route::get('/downloadPDF/{id}', [kegiatanController::class, 'downloadPDF'])->middleware('auth');
Route::get('/kegiatan/export/{start}/{end}', [kegiatanController::class, 'export'])->middleware('auth');
// Route::get('/kegiatan/export/', [kegiatanController::class, 'export'])->middleware('auth');

//Add User Section
Route::get('/user-area', [AdduserController::class, 'index'])->middleware('auth')->name('users');
Route::get('/tambah-user', [AdduserController::class, 'adduser'])->middleware('auth')->name('adduser');
Route::post('/simpan-user', [AdduserController::class, 'save'])->middleware('auth')->name('simpan_user');
Route::delete('/hapus-user/{id}', [AdduserController::class, 'hapus'])->middleware('auth');
Route::put('/update-user/{id}',[AdduserController::class, 'updateuser'])->middleware('auth');

// kejadian Section
Route::get('/kejadian', [KejadianController::class, 'index'])->middleware('auth')->name('kejadian');