<?php

use App\Admin\Controllers\AlumniController;
use App\Admin\Controllers\BeritaController;
use App\Admin\Controllers\EkstrakurikulerController;
use App\Admin\Controllers\GafotoController;
use App\Admin\Controllers\GavideoController;
use App\Admin\Controllers\IdentiSekolahController;
use App\Admin\Controllers\JurusanController;
use App\Admin\Controllers\KatalumController;
use App\Admin\Controllers\KepsekController;
use App\Admin\Controllers\LayananController;
use App\Admin\Controllers\ProfilSekolahController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\VimisiController;

use Illuminate\Support\Facades\Route; // ✅ perbaikan di sini
use OpenAdmin\Admin\Facades\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function ($router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('layanans', LayananController::class);
    $router->resource('kepseks', KepsekController::class);
    $router->resource('beritas', BeritaController::class);
    $router->resource('profil-sekolahs', ProfilSekolahController::class);
    $router->resource('vimisis', VimisiController::class);
    $router->resource('identi-sekolahs', IdentiSekolahController::class);
    $router->resource('jurusans', JurusanController::class);
    $router->resource('kata-alumnis', KatalumController::class);
    $router->resource('gavideos', GavideoController::class);
    $router->resource('ekstrakurikulers', EkstrakurikulerController::class);
    $router->resource('gafotos', GafotoController::class);
    $router->resource('alumnis', AlumniController::class);
});
