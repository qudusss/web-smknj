<?php

use App\Http\Controllers\PengumumanSMKController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\AlumniSmkController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilSMKNJController;
use App\Http\Controllers\ProgramSMKNJController;
use App\Http\Controllers\DownloadSMKNJController;
use App\Http\Controllers\ChatbotController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('profil-smknj', [ProfilSMKNJController::class, 'index'])->name('smknj.index');
Route::get('visi-misi-smknj', [ProfilSMKNJController::class, 'vimisi'])->name('smknj.vimisi');
Route::get('identitas-smknj', [ProfilSMKNJController::class, 'identitas'])->name('smknj.identitas');

Route::get('program-keahlian', [ProgramSMKNJController::class, 'keahlian'])->name('program.keahlian');
Route::get('ekstrakurikuler', [EkstrakurikulerController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');

// alumni
Route::get('alumni-smknj', [AlumniSmkController::class, 'tracer_study'])->name('alumni');

Route::get('alumni-smknj/change_status/{id}', [AlumniSmkController::class, 'status_kehadiran'])->name('change_status');
Route::put('alumni-smknj/update_status/{id}', [AlumniSmkController::class, 'update_status'])->name('update_status');
Route::put('alumni-smknj/updateNisn/{id}', [AlumniSmkController::class, 'updateNisn'])->name('updateNisn');

Route::get('galeri-foto', [GaleriController::class, 'foto'])->name('galeri.foto');
Route::get('galeri-video', [GaleriController::class, 'video'])->name('galeri.video');
Route::get('galeri-prestasi', [PrestasiController::class, 'prestasi'])->name('galeri.prestasi');

Route::get('daftar-berita', [BeritaController::class, 'index'])->name('berita-sekolah');
Route::get('detail-berita/{id}', [BeritaController::class, 'detail_berita'])->name('detail-berita');

Route::get('/cek-kelulusan', [KelulusanController::class, 'showCheckForm'])->name('kelulusan.check');
Route::post('/hasil-kelulusan', [KelulusanController::class, 'processCheck'])->name('kelulusan.process');

Route::get('pengumuman', [PengumumanSMKController::class, 'index'])->name('pengumuman.index');

Route::get('download', [DownloadSMKNJController::class, 'index'])->name('download.index');

Route::post('/ai-chat', [ChatbotController::class, 'sendMessage']);

Route::get('kontak', function () {
    return view('kontak');
})->name('kontak_kami');

Route::get('ppdb-smknj', function () {
    return view('info_ppdb');
})->name('ppdb');
