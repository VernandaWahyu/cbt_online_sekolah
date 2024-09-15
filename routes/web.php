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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});

//section login page
Route::get('/', function(){
    return Redirect::to('login');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    //route ke dashboard
    Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index']);

    //route program bimbel
    Route::get('/program_bimbel', [App\Http\Controllers\ProgramBimbelController::class, 'index']);
    Route::get('/program_bimbel/edit/{id}', [App\Http\Controllers\ProgramBimbelController::class, 'edit']);
    Route::post('/program_bimbel/store', [App\Http\Controllers\ProgramBimbelController::class, 'store']);
    Route::delete('/program_bimbel/delete/{id}', [App\Http\Controllers\ProgramBimbelController::class, 'destroy']);
    Route::post('/program_bimbel/update', [App\Http\Controllers\ProgramBimbelController::class, 'update']);
    Route::get('/program_bimbel/api', [App\Http\Controllers\ProgramBimbelController::class, 'apiProgramBimbel']);

    //route kelas
    Route::get('/kelas', [App\Http\Controllers\KelasController::class, 'index']);
    Route::get('/kelas/edit/{id}', [App\Http\Controllers\KelasController::class, 'edit']);
    Route::post('/kelas/store', [App\Http\Controllers\KelasController::class, 'store']);
    Route::delete('/kelas/delete/{id}', [App\Http\Controllers\KelasController::class, 'destroy']);
    Route::post('/kelas/update', [App\Http\Controllers\KelasController::class, 'update']);
    Route::get('/kelas/api', [App\Http\Controllers\KelasController::class, 'apiKelas']);
    Route::get('/kelas/list_program', [App\Http\Controllers\KelasController::class, 'listProgram']);
    Route::get('/kelas/list_program_kelas', [App\Http\Controllers\KelasController::class, 'listProgramKelas']);
    Route::get('/kelas/list_kelas', [App\Http\Controllers\KelasController::class, 'listKelas']);
    Route::get('/kelas/list_siswa/{id}', [App\Http\Controllers\KelasController::class, 'listSiswa']);
    Route::get('/kelas/api/list_siswa/{id}', [App\Http\Controllers\KelasController::class, 'apiListSiswa']);

    Route::get('/kelas/tambah_siswa/{id}', [App\Http\Controllers\KelasController::class, 'tambahSiswa']);
    Route::post('/kelas/get_list_siswa', [App\Http\Controllers\KelasController::class, 'getListSiswa']);

    Route::post('/kelas/simpan/list_siswa', [App\Http\Controllers\KelasController::class, 'simpanListSiswa']);
    Route::delete('/kelas/delete/list_siswa/{id}', [App\Http\Controllers\KelasController::class, 'deleteListSiswa']);
    Route::get('/kelas/cetak/{id}', [App\Http\Controllers\KelasController::class, 'cetakSiswa']);

    //route siswa
    Route::get('/siswa/list', [App\Http\Controllers\SiswaController::class, 'index']);
    Route::get('/siswa/edit/{id}', [App\Http\Controllers\SiswaController::class, 'edit']);
    Route::post('/siswa/store', [App\Http\Controllers\SiswaController::class, 'store']);
    Route::delete('/siswa/delete/{id}', [App\Http\Controllers\SiswaController::class, 'destroy']);
    Route::post('/siswa/update', [App\Http\Controllers\SiswaController::class, 'update']);
    Route::post('/siswa/status', [App\Http\Controllers\SiswaController::class, 'status']);
    Route::get('/siswa/api', [App\Http\Controllers\SiswaController::class, 'apiSiswa']);
    Route::get('/siswa/cetak', [App\Http\Controllers\SiswaController::class, 'cetak']);
    Route::post('/siswa/import', [App\Http\Controllers\SiswaController::class, 'import']);

    //route guru
    Route::get('/guru', [App\Http\Controllers\GuruController::class, 'index']);
    Route::get('/guru/edit/{id}', [App\Http\Controllers\GuruController::class, 'edit']);
    Route::post('/guru/store', [App\Http\Controllers\GuruController::class, 'store']);
    Route::delete('/guru/delete/{id}', [App\Http\Controllers\GuruController::class, 'destroy']);
    Route::post('/guru/update', [App\Http\Controllers\GuruController::class, 'update']);
    Route::get('/guru/api', [App\Http\Controllers\GuruController::class, 'apiGuru']);

    //route bank soal
    Route::get('/bank_soal', [App\Http\Controllers\BankSoalController::class, 'index']);
    Route::get('/bank_soal/edit/{id}', [App\Http\Controllers\BankSoalController::class, 'edit']);
    Route::get('/bank_soal/detail/{id}', [App\Http\Controllers\BankSoalController::class, 'show'])->name('detail-soal');
    Route::post('/bank_soal/store', [App\Http\Controllers\BankSoalController::class, 'store']);
    Route::delete('/bank_soal/delete/{id}', [App\Http\Controllers\BankSoalController::class, 'destroy']);
    Route::post('/bank_soal/update', [App\Http\Controllers\BankSoalController::class, 'update']);
    Route::get('/bank_soal/api', [App\Http\Controllers\BankSoalController::class, 'apiBankSoal']);
    Route::get('/bank_soal/detail', [App\Http\Controllers\BankSoalController::class, 'apiBankSoalDetail']);
    Route::get('/bank_soal/list_guru', [App\Http\Controllers\BankSoalController::class, 'listGuru']);

    // store soal
    Route::post('bank_soal/soal/store', [App\Http\Controllers\BankSoalController::class, 'BankSoalStore'])->name('soal-store');
    Route::get('bank_soal/soal/edit', [App\Http\Controllers\BankSoalController::class, 'BankSoalEdit'])->name('soal-edit');
    Route::get('bank_soal/soal/tambah', [App\Http\Controllers\BankSoalController::class, 'BankSoalTambah'])->name('soal-tambah');
    Route::post('bank_soal/soal/update/{id}', [App\Http\Controllers\BankSoalController::class, 'BankSoalUpdate'])->name('soal-update');
    Route::delete('/bank_soal/soal/delete/{id}', [App\Http\Controllers\BankSoalController::class, 'soalDestroy']);
    Route::post('bank_soal/soal/report/{id}', [App\Http\Controllers\BankSoalController::class, 'BankSoalExport'])->name('soal-export');
    Route::get('bank_soal/soal/print/{id}/{opsi}', [App\Http\Controllers\BankSoalController::class, 'BankSoalPrint'])->name('soal-print');
    Route::get('bank_soal/soal/backup/{id}', [App\Http\Controllers\BankSoalController::class, 'BankSoalBackup'])->name('soal-backup');
    Route::post('bank_soal/soal/import/{id}', [App\Http\Controllers\BankSoalController::class, 'BankSoalImport'])->name('soal-import');
    Route::post('bank_soal/soal/upload/{id}', [App\Http\Controllers\BankSoalController::class, 'BankSoalUpload'])->name('soal-upload');

    Route::post('/ckeditor/upload', [App\Http\Controllers\BankSoalController::class, 'upload'])->name('ckeditor.upload');

    Route::post('/bank_soal/soal/image/post', [App\Http\Controllers\BankSoalController::class, 'uploadImage'])->name('post.image');

    //route ujian
    Route::get('/ujian', [App\Http\Controllers\UjianController::class, 'index']);
    Route::get('/ujian/edit/{id}', [App\Http\Controllers\UjianController::class, 'edit']);
    Route::post('/ujian/store', [App\Http\Controllers\UjianController::class, 'store']);
    Route::delete('/ujian/delete/{id}', [App\Http\Controllers\UjianController::class, 'destroy']);
    Route::post('/ujian/update', [App\Http\Controllers\UjianController::class, 'update']);
    Route::get('/ujian/api', [App\Http\Controllers\UjianController::class, 'apiUjian']);
    Route::get('/ujian/list_kategori_ujian', [App\Http\Controllers\UjianController::class, 'listKategoriUjian']);
    Route::get('/ujian/detail/{id}', [App\Http\Controllers\UjianController::class, 'show'])->name('admin.ujian.detail');
    Route::get('/ujian/list_soal', [App\Http\Controllers\UjianController::class, 'apiUjianSoal']);
    Route::get('/ujian/detail_soal/{id}', [App\Http\Controllers\UjianController::class, 'detailSoal']);
    Route::get('/ujian/tambah_soal/{id}', [App\Http\Controllers\UjianController::class, 'tambahSoal']);
    Route::post('/ujian/get_list_soal', [App\Http\Controllers\UjianController::class, 'getListSoal']);
    Route::post('/ujian/simpan_soal', [App\Http\Controllers\UjianController::class, 'simpanSoal']);
    Route::delete('/ujian/delete_soal/{id}', [App\Http\Controllers\UjianController::class, 'hapusSoal']);
    Route::get('/ujian/list_siswa/{id}', [App\Http\Controllers\UjianController::class, 'listSiswa']);
    Route::get('/ujian/api/list_siswa/{id}', [App\Http\Controllers\UjianController::class, 'apiListSiswa']);
    Route::delete('/ujian/delete/list_siswa/{id}', [App\Http\Controllers\UjianController::class, 'deleteListSiswa']);
    Route::get('/ujian/tambah/list_siswa/{id}', [App\Http\Controllers\UjianController::class, 'tambahListSiswa']);
    Route::post('/ujian/simpan/list_siswa', [App\Http\Controllers\UjianController::class, 'simpanListSiswa']);
    Route::get('/ujian/kelas/list_siswa/{id}', [App\Http\Controllers\UjianController::class, 'kelasListSiswa']);
    Route::post('/ujian/get_list_siswa', [App\Http\Controllers\UjianController::class, 'getListSiswa']);
    Route::get('/ujian/export_hasil_siswa/{id}', [App\Http\Controllers\UjianController::class, 'exportHasilSiswa']);
    Route::get('/ujian/show_nilai/{id}', [App\Http\Controllers\UjianController::class, 'showNilai']);

    //section siswa
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
    Route::get('/siswa/ujian/{id}', [App\Http\Controllers\UjianSiswaController::class, 'ujian']);
    Route::get('/siswa/ujian_page/{id}', [App\Http\Controllers\UjianSiswaController::class, 'ujianPage']);
    Route::get('/siswa/list_hasil_ujian', [App\Http\Controllers\UjianSiswaController::class, 'listHasilUjian']);

    Route::get('/list', [App\Http\Controllers\HomeController::class, 'list']);
    Route::get('/load_ujian', [App\Http\Controllers\HomeController::class, 'loadUjian']);
    Route::get('/confirm/{id_ujian}', [App\Http\Controllers\HomeController::class, 'confirm']);
    Route::get('/soal/{id_ujian}', [App\Http\Controllers\HomeController::class, 'soal']);
    Route::get('/soal_detail/{id}', [App\Http\Controllers\HomeController::class, 'soal_detail']);
    Route::post('/soal_detail_baru', [App\Http\Controllers\HomeController::class, 'soal_detail_baru']);
    Route::post('/update_timer', [App\Http\Controllers\HomeController::class, 'updateTimer']);

    Route::post('/soal_detail_prev', [App\Http\Controllers\HomeController::class, 'soal_detail_prev']);
    Route::post('/soal_detail_next', [App\Http\Controllers\HomeController::class, 'soal_detail_next']);

    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
    Route::post('/profile_update', [App\Http\Controllers\HomeController::class, 'profile_update']);
    Route::post('/siswa/ujian/reset_jawaban', [App\Http\Controllers\HomeController::class, 'ujianResetJawaban']);
    Route::post('/siswa/ujian/simpan_jawaban', [App\Http\Controllers\HomeController::class, 'ujianSimpanJawaban']);
    Route::get('/siswa/hasil_ujian/{id_ujian}', [App\Http\Controllers\HomeController::class, 'hasilUjian']);
    Route::get('/siswa/reset_ujian/{id_ujian}', [App\Http\Controllers\HomeController::class, 'resetUjian']);
    Route::get('/siswa/hasil_ujian_detail/{id_ujian}', [App\Http\Controllers\HomeController::class, 'hasilUjianDetail']);

    Route::get("/hasil", function(){
        return view("siswa.hasil");
    });
    
});