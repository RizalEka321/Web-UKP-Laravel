<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisimisiController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\PengajuanController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Chart
    Route::get('/tampildatachart', [HomeController::class, 'dataChart']);
    Route::get('/data-chart-prodi', [HomeController::class, 'dataChartProdi']);
    Route::get('/data-chart-kategori', [HomeController::class, 'dataChartKategori']);
    // Kerjasama
    Route::get('/kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama');
    Route::get('/kerjasama/create', [KerjasamaController::class, 'create'])->name('kerjasama.create');
    Route::post('/kerjasama/store', [KerjasamaController::class, 'store'])->name('kerjasama.store');
    Route::get('/kerjasama/show/{id}', [KerjasamaController::class, 'show'])->name('kerjasama.show');
    Route::get('/kerjasama/edit/{id}', [KerjasamaController::class, 'edit'])->name('kerjasama.edit');
    Route::put('/kerjasama/update/{id}', [KerjasamaController::class, 'update'])->name('kerjasama.update');
    Route::delete('/kerjasama/delete/{id}', [KerjasamaController::class, 'destroy'])->name('kerjasama.delete');
    Route::get('/kerjasama/cari', [KerjasamaController::class, 'cari'])->name('cari')->name('kerjasama.cari');
    Route::get('/kerjasama/download/{mou}', [KerjasamaController::class, 'download'])->name('kerjasama.download');
    // Pengajuan
    Route::get('/pengajuan-kerja-sama', [PengajuanController::class, 'pengajuanKerjasama']);
    Route::post('/pengajuan-kerjasama', [PengajuanController::class, 'store']);
    // Aktivitas
    Route::get('/aktivitas', [PostController::class, 'index'])->name('aktivitas');
    Route::get('/aktivitas/create', [PostController::class, 'create'])->name('aktivitas.create');
    Route::post('/aktivitas/store', [PostController::class, 'store'])->name('aktivitas.store');
    Route::get('/aktivitas/show/{id}', [PostController::class, 'show'])->name('aktivitas.show');
    Route::get('/aktivitas/edit/{id}', [PostController::class, 'edit'])->name('aktivitas.edit');
    Route::put('/aktivitas/update/{id}', [PostController::class, 'update'])->name('aktivitas.update');
    Route::get('/aktivitas/delete/{id}', [PostController::class, 'destroy'])->name('aktivitas.delete');
    // MOU
    Route::get('/file-mou', [FileController::class, 'index'])->name('file-mou');
    Route::get('/file-mou/create', [FileController::class, 'create'])->name('file-mou.create');
    Route::post('/file-mou/store', [FileController::class, 'store'])->name('file-mou.store');
    Route::get('/file-mou/edit/{id}', [FileController::class, 'edit'])->name('file-mou.edit');
    Route::put('/file-mou/update/{id}', [FileController::class, 'update'])->name('file-mou.update');
    Route::get('/file-mou/download/{id}', [FileController::class, 'download'])->name('file-mou.download');
    Route::get('/file-mou/delete/{id}', [FileController::class, 'destroy'])->name('file-mou.delete');
    // Export PDF
    Route::get('/export-pdf/{id}', [ExportController::class, 'exportPDF'])->name('export-pdf');
    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    // Panduan
    Route::get('/panduan/{id}', [PanduanController::class, 'index'])->name('panduan');
    Route::put('/panduan/update/{id}', [PanduanController::class, 'update'])->name('panduan.update');
    // Visimisi
    Route::get('/visi-misi/{id}', [VisimisiController::class, 'index'])->name('visi-misi');
    Route::put('/visi-misi/update/{id}', [VisimisiController::class, 'update'])->name('visi-misi.update');
    // Struktur
    Route::get('/struktur/{id}', [StrukturController::class, 'index'])->name('struktur');
    Route::put('/struktur/update/{id}', [StrukturController::class, 'update'])->name('struktur.update');
});

Route::get('/page-tampildatachart', [PageController::class, 'dataChart']);
Route::get('/page-data-chart-prodi', [PageController::class, 'dataChartProdi']);
Route::get('/page-data-chart-kategori', [PageController::class, 'dataChartKategori']);

Route::get('/', [PageController::class, 'page_home'])->name('page_home');
Route::get('/page-struktur', [PageController::class, 'page_struktur'])->name('page_struktur');
Route::get('/page-visi-misi', [PageController::class, 'page_visi_misi'])->name('page_visi_misi');
Route::get('/page-aktivitas', [PageController::class, 'page_aktivitas'])->name('page_aktivitas');
Route::get('/page-aktivitas/detail/{id}', [PageController::class, 'page_detail_aktivitas'])->name('page_detail_aktivitas');
Route::get('/page-panduan', [PageController::class, 'page_panduan'])->name('page_panduan');
Route::get('/page-download-mou', [PageController::class, 'page_download'])->name('page_download');
Route::get('/page-kerjasama', [PageController::class, 'page_kerjasama'])->name('page_kerjasama');
