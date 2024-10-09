<?php

use App\Http\Controllers\AdduserController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AtensiController;
use App\Http\Controllers\BencanaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinvendorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OtorisasiController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PersonilController;
use App\Http\Controllers\PosjagaController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SmcController;
use App\Http\Controllers\TemuanController;
use App\Http\Controllers\TukarjagaController;
use App\Http\Controllers\UnrasController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\GrafikUnras;
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
    return view('auth.login');
});

Auth::routes();

// Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');
// Route::get('/tasks',[HomeController::class, 'task'])->name('get_tasks');

//GrafikUnras
Route::get('/grafik', GrafikUnras::class)->middleware('auth')->name('grafik');

// Personil section
Route::get('/edit-personil', function () {
    return view('personil.edit');
})->middleware('auth')->name('edit-personil');

Route::post('/personil/simpan',[PersonilController::class, 'simpan'])->middleware('auth')->name('simpan_personil');
Route::put('/personil-update/{id}',[PersonilController::class, 'update'])->middleware('auth');
Route::get('/personil', [PersonilController::class, 'index'])->middleware('auth')->name('personil');
Route::get('/tambah-personil', [PersonilController::class, 'showInput'])->middleware('auth')->name('tambah-personil');
Route::get('/personil/{id}', [PersonilController::class, 'detil'])->middleware('auth'); 
Route::get('/edit-personil/{id}', [PersonilController::class, 'edit'])->middleware('auth'); 
Route::delete('/hapus-personil/{id}', [PersonilController::class, 'hapus'])->middleware('auth');
Route::get('/hapus-fopro/{id}', [PersonilController::class, 'hapusProfil'])->middleware('auth');
Route::get('/hapus-kta/{id}', [PersonilController::class, 'hapusKta'])->middleware('auth');
Route::get('/hapus-bpjss/{id}', [PersonilController::class, 'hapusBpjss'])->middleware('auth');
Route::get('/hapus-bpjsk/{id}', [PersonilController::class, 'hapusBpjsk'])->middleware('auth');

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

Route::get('/edit-pos', function () {
    return view('posjaga.edit');
})->middleware('auth')->name('edit-pos');
Route::get('/tambah-pos', [PosjagaController::class, 'tambah'])->middleware('auth')->name('tambah-pos');
Route::get('/posjaga', [PosjagaController::class, 'index'])->middleware('auth')->name('posjaga');
Route::put('/pos-update/{id}',[PosjagaController::class, 'update'])->middleware('auth');
Route::get('/pos/hapus-foto/{item}/{id}', [PosjagaController::class, 'hapusFoto'])->middleware('auth');
Route::get('/edit-pos/{id}', [PosjagaController::class, 'edit'])->middleware('auth');
Route::get('/hapus-pos/{id}', [PosjagaController::class, 'hapus'])->middleware('auth');
Route::post('/simpan-pos', [PosjagaController::class, 'simpan'])->middleware('auth')->name('simpan_pos');

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
Route::get('/kegiatan', [KegiatanController::class, 'index'])->middleware('auth')->name('kegiatan');
Route::get('/tambah-giat', [KegiatanController::class, 'tambah'])->middleware('auth')->name('tambah-giat');
Route::post('/simpan-giat', [KegiatanController::class, 'simpan'])->middleware('auth')->name('simpan_giat');
Route::get('/giat-detil/{id}', [KegiatanController::class, 'detil'])->middleware('auth'); 
Route::get('/edit-giat/{id}', [KegiatanController::class, 'edit'])->middleware('auth');
Route::put('/update-giat/{id}',[KegiatanController::class, 'update'])->middleware('auth');
Route::delete('/hapus-giat/{id}', [KegiatanController::class, 'hapus'])->middleware('auth');
Route::get('/giat/hapus-foto/{item}/{id}', [KegiatanController::class, 'hapusFoto'])->middleware('auth');

//Tukarjaga Section
Route::get('/tukarjaga', [TukarjagaController::class, 'index'])->middleware('auth')->name('tukarjaga');
Route::get('/tukar-tambah', [TukarjagaController::class, 'input'])->middleware('auth')->name('tukar-tambah');
Route::post('/simpan-tukar', [TukarjagaController::class, 'simpan'])->middleware('auth')->name('simpan_tukar');
Route::get('/trj-detil/{no_trj}/{id}', [TukarjagaController::class, 'detil'])->middleware('auth'); 
Route::delete('/hapus-jaga/{id}', [TukarjagaController::class, 'hapus'])->middleware('auth');
Route::get('/edit-lap/{id}', [TukarjagaController::class, 'edit'])->middleware('auth');
Route::get('/autocomplete', [TukarjagaController::class, 'autocomplete'])->name('autocomplete')->middleware('auth');

//Delete area
Route::delete('/hapus-shiftlama/{item}/{trj}', [TukarjagaController::class, 'hapuslama'])->middleware('auth');
Route::delete('/hapus-shiftbaru/{item}/{trj}', [TukarjagaController::class, 'hapusbaru'])->middleware('auth');
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
Route::get('/viewpdf/{id}', [TukarjagaController::class, 'generatePDF'])->middleware('auth');
Route::get('/tukarjaga/export/{start}/{end}', [TukarjagaController::class, 'export'])->middleware('auth');
Route::get('/downloadPDF/{id}', [KegiatanController::class, 'downloadPDF'])->middleware('auth');
Route::get('/kegiatan/export/{start}/{end}', [KegiatanController::class, 'export'])->middleware('auth');
Route::get('/kejadian/export/{start}/{end}/{count}', [KejadianController::class, 'export'])->middleware('auth');
Route::get('/layanan/export/{start}/{end}/{count}', [LayananController::class, 'export'])->middleware('auth');
Route::get('/kejadianPDF/{id}/{oto}/{val}', [KejadianController::class, 'kejadianPDF'])->middleware('auth');
Route::get('/unrasojk/export/{start}/{end}/{count}/{cariin}', [UnrasController::class, 'exportojk'])->middleware('auth');
Route::get('/unras/export/{start}/{end}/{count}', [UnrasController::class, 'export'])->middleware('auth');
Route::get('/unrasPDF/{start}/{end}', [UnrasController::class, 'unrasPDF'])->middleware('auth');
Route::get('/unrasOJK/{start}/{end}/{cariin}', [UnrasController::class, 'unrasOJK'])->middleware('auth');


//Add User Section
Route::get('/user-area', [AdduserController::class, 'index'])->middleware('auth')->name('users');
Route::get('/tambah-user', [AdduserController::class, 'adduser'])->middleware('auth')->name('adduser');
Route::post('/simpan-user', [AdduserController::class, 'save'])->middleware('auth')->name('simpan_user');
Route::delete('/hapus-user/{id}', [AdduserController::class, 'hapus'])->middleware('auth');
Route::put('/update-user/{id}',[AdduserController::class, 'updateuser'])->middleware('auth');

// kejadian Section
Route::controller(KejadianController::class)->middleware('auth')->group(function () {
    Route::get('/kejadian', 'index')->name('kejadian');
    Route::get('/kejadian-edit/{id}', 'edit');
    Route::get('/kejadian/hapus/{id}', 'hapus');
    Route::get('/kejadian-detil/{id}', 'detil');
    Route::get('/kejadian-tambah', 'tambah')->name('jadi-tambah');
    Route::post('/kejadian/simpan', 'simpan')->name('jadi-simpan');
    Route::put('/kejadian-update/{id}', 'update');
    Route::get('/kejadian/hapus-foto/{item}/{id}', 'hapusFoto');
    Route::delete('/kejadian/hapus/{id}', 'hapus');
    Route::get('/kejadian/status/{id}', 'status');
    Route::get('/kejadian/otorisasi/{id}/{oto}', 'otorisasi');
    Route::get('/kejadian/validasi/{id}', 'validasi');
    Route::get('/kejadian/validasi/{id}/{val}', 'validmin');
});

// Unras Section
Route::get('/unras', [UnrasController::class, 'index'])->middleware('auth')->name('unras');
Route::post('/simpan-unras', [UnrasController::class, 'simpan'])->middleware('auth')->name('simpan-unras');
Route::get('/automasi', [UnrasController::class, 'automasi'])->middleware('auth')->name('automasi');
Route::get('/automasi2', [UnrasController::class, 'automasi2'])->middleware('auth')->name('automasi2');
Route::put('/update-unras/{id}', [UnrasController::class, 'update'])->middleware('auth');
Route::delete('/unras/hapus/{id}', [UnrasController::class, 'hapus'])->middleware('auth');



//Bencana
Route::get('/bencana', [BencanaController::class, 'index'])->middleware('auth')->name('bencana');
Route::get('/bencana-tambah', [BencanaController::class, 'tambah'])->middleware('auth')->name('tambah-bencana');
Route::post('/simpan-bencana', [BencanaController::class, 'simpan'])->middleware('auth')->name('simpan_bencana');
Route::get('/edit-bencana/{id}', [BencanaController::class, 'edit'])->middleware('auth');
Route::get('/bencana/hapus-foto/{item}/{id}', [BencanaController::class, 'hapusFoto'])->middleware('auth');
Route::get('/bencana-detil/{id}', [BencanaController::class, 'detil'])->middleware('auth');
Route::put('/update-bencana/{id}', [BencanaController::class, 'update'])->middleware('auth');
Route::get('/savePDF/{id}/{oto}', [BencanaController::class, 'savePDF'])->middleware('auth');
Route::get('/bencana/status/{id}', [BencanaController::class, 'status'])->middleware('auth');
Route::delete('/hapus-bencana/{id}', [BencanaController::class, 'hapus'])->middleware('auth');
Route::get('/select2', [BencanaController::class, 'select2'])->name('select2')->middleware('auth');


//Temuan Section
Route::get('/temuan', [TemuanController::class, 'index'])->middleware('auth')->name('temuan');
Route::get('/temuan-tambah', [TemuanController::class, 'tambah'])->middleware('auth')->name('tambah-temuan');
Route::post('/simpan-temuan', [TemuanController::class, 'simpan'])->middleware('auth')->name('simpan_temuan');
Route::get('/temuan/status/{id}', [TemuanController::class, 'status'])->middleware('auth');
Route::get('/temuan-detil/{id}', [TemuanController::class, 'detil'])->middleware('auth');
Route::get('/temuan-edit/{id}', [TemuanController::class, 'edit'])->middleware('auth');
Route::delete('/hapus-temuan/{id}', [TemuanController::class, 'hapus'])->middleware('auth');
Route::get('/temuanPDF/{id}', [TemuanController::class, 'temuanPDF'])->middleware('auth');
Route::put('/update-temuan/{id}', [TemuanController::class, 'update'])->middleware('auth');
Route::get('/temuan/hapus-foto/{item}/{id}', [TemuanController::class, 'hapusFoto'])->middleware('auth');


//Otorisasi Section
Route::get('/otorisasi', [OtorisasiController::class, 'index'])->middleware('auth')->name('otorisasi');
Route::post('/simpan_otorisasi', [OtorisasiController::class, 'simpan'])->middleware('auth');
Route::put('/update-otorisasi/{id}', [OtorisasiController::class, 'update'])->middleware('auth');
Route::delete('otorisasi/hapus/{id}', [OtorisasiController::class, 'hapus'])->middleware('auth');


//SMC Section
Route::controller(SmcController::class)->middleware('auth')->group(function () {
    Route::get('/laporan_smc', 'index')->name('laporan_smc');
    Route::get('/buat_laporan', 'tambah')->name('buat_laporan'); 
    Route::post('/simpan-otorisasi','simpan')->name('simpan_lap_smc'); 
    Route::get('/smc_detil/{id}', 'detil');
    Route::get('/edit_smc/{id}', 'edit');
    Route::put('/update_smc/{id}', 'update');
    Route::get('/hapus_foto_smc/{item}/{id}', 'hapusFoto');
    Route::delete('/hapus-item/{id}', 'hapus');
    Route::get('/smcPDF/{id}',  'smcPDF');
});

//Atensi Section
Route::controller(AtensiController::class)->middleware('auth')->group(function () {
    Route::get('/atensi', 'index')->name('atensi');
    Route::get('/lap_atensi', 'create')->name('lap_atensi');
    Route::get('/input_atensi/{id}', 'create2');
    Route::post('/simpan_atensi','store')->name('simpan_atensi'); 
    Route::get('/atensi_detil/{id}', 'show');
    Route::get('/edit_atensi/{id}', 'edit');
    Route::get('/atensiPDF/{id}/{oto}',  'atensiPDF');
    Route::delete('/hapus_atensi/{id}', 'destroy');
    Route::put('/update_atensi/{id}', 'update');

});

Route::controller(RekapController::class)->middleware('auth')->group(function () {
    Route::get('/rekap', 'index')->name('rekap');
    Route::get('/tambah_rekap', 'create')->name('tambah_rekap');
    Route::post('/simpan_rekap','store')->name('simpan_rekap'); 
    Route::get('/rekap_detil/{id}', 'show');
    Route::delete('/hapus_rekap/{id}', 'destroy');
});

//filemanaager
Route::get('/filemanager', [FmController::class, 'index'])->middleware('auth')->name('filemanager');

// Pekerjaan vendor
Route::get('/form-izin', function () {
    return view('pekerjaan.form');
})->name('form_izin');

// Route::get('/update_pekerjaan', function () {
//     return view('pekerjaan.update_pekerjaan');
// })->name('update_pekerjaan');

// Route::get('/form-izin', [IzinvendorController::class, 'form'])->name('form_izin');
Route::get('/update_pekerjaan', [IzinvendorController::class, 'update_pekerjaan']);
Route::put('/update_pekerjaan/{izinid}', [IzinvendorController::class, 'update_pekerjaan2']);

Route::post('/simpan_izin', [IzinvendorController::class, 'store'])->name('simpan_izin');

// Route::get('/form-izin', [PekerjaanController::class, 'form'])->name('form_izin');
Route::controller(IzinvendorController::class)->middleware('auth')->group(function () {
    Route::get('/izin-kerja', 'index')->name('izin_kerja');
    Route::get('/izin-detail/{id}', 'detail');
    Route::get('/izin-validasi/{izinid}', 'valid');
    Route::get('/izin-edit/{id}', 'edit');
    Route::put('/simpan_validasi/{izinid}', 'validasi');
    Route::get('/hapus-selamat/{id}', 'hapus_slmt');
    Route::get('/update_risiko/{id}', 'update_risiko');
    Route::get('/update_klasifikasi/{id}', 'update_klasifikasi');
    Route::get('/update_info/{id}', 'update_info');
    Route::get('/update_perlengkapan/{id}', 'update_perlengkapan');
    Route::get('/update_selamat/{izinid}', 'tambahSlmt');
    Route::put('/update_apdk/{id}', 'update_apdk');
    Route::get('/hapus_alat/{alat}/{id}/{jmlalt}', 'hapus_alat');
    Route::get('/hapus_mesin/{mesin}/{id}/{jmlmsn}', 'hapus_mesin');
    Route::get('/hapus_material/{material}/{id}/{jmlmtr}', 'hapus_material');
    Route::get('/hapus_alatberat/{alber}/{id}/{jmlalber}', 'hapus_alatberat');
    Route::get('/hapus_kslmtn/{id}', 'hapus_kslmtn');
    Route::get('/hapus_apd/{id}/{apd}', 'hapus_apd');
    Route::get('/hapus_apk/{id}/{apk}', 'hapus_apk');
    Route::get('/izin-downloadPDF/{id}/{oto}', 'downloadPDF');
    Route::get('/izin-downloadPDF/{id}/{oto}/{val}', 'downloadPDF2');
    Route::delete('/hapus-izin/{izinid}', 'hapus');
    Route::get('/izinkerja/{cari}/{start}/{end}', 'izinkerja1');
    Route::get('/izinkerja/{start}/{end}', 'izinkerja2');
    Route::get('/izinkerja/{cari}', 'izinkerja3');
    Route::get('/otorisasi/{id}/{otoid}', 'otorisasi');
});

Route::get('/upja', [IzinvendorController::class, 'upja'])->name('upja');

// Route::get('maintenance', function() {
//     return view('maintenance');
// });


//Kelogistikan

// Route::get('/form-layanan', function () {
//     return view('layanan.form');
// })->name('form_layanan');

Route::get('/form-layanan/logistik', [LayananController::class, 'create']);
Route::get('/form-layanan/pam', [LayananController::class, 'create2']);

Route::controller(LayananController::class)->middleware('auth')->group(function () {
    Route::get('/layanan', 'index')->name('layanan');
    Route::get('/layanan/detail/{id}', 'show');
    Route::get('/layanan/edit/{id}', 'edit');
    Route::get('/layanan/validasi/{id}', 'validasi');
    Route::delete('/layanan/destroy/{id}', 'destroy');
    Route::post('/layanan/valid/{id}', 'valid');
    Route::post('/layanan/valid/{id}/{val}', 'validamin');
    Route::get('/layanan/detail/{id}/{oto}/{val}', 'savePDF');
    Route::get('/layanan/otorisasi/{id}/', 'superoto');
    Route::get('/layanan/otorisasi/{id}/{oto}', 'otor');
    Route::get('/layanan/otorisasi/{id}/{oto}/{note}', 'otori');
    Route::get('/layanan/hapus/{foto}/{id}', 'hapusFoto');
    Route::put('/layanan/update/{id}', 'update');

});

Route::controller(LayananController::class)->group(function () {
    Route::post('/store', 'store')->name('store_layanan');
    Route::get('/layanan/status/', 'status');
    Route::put('/layanan/status/{id}', 'status2');
    Route::put('/layanan/survei/{id}', 'survei');
    Route::get('stat', 'stat')->name('stat');
});

Route::get('/side', [Controller::class, 'side'])->name('side')->middleware('auth');

//User Online 

Route::get('/useronline', [UserController::class, 'index'])->middleware('auth')->name('useronline');