<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cabang\CabangController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Master\ConfigController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\StorageController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/hapus', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');

    return 'DONE';
});
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('post-login', [LoginController::class, 'postlogin'])->name('post.login');
Route::get('login/cek-username/json', [LoginController::class, 'cekusername']);
Route::get('login/cek-password/json', [LoginController::class, 'cekpassword']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', UsersController::class);
    Route::get('users/{id}/storage', [UsersController::class, 'editStorage']);
    Route::post('users/up_storage', [UsersController::class, 'up_storage'])->name('users.up_storage');
    Route::get('pengaturan/ubah-password', [UsersController::class, 'edit_password'])->name('ubah.password');
    Route::post('pengaturan/simpan-password', [UsersController::class, 'simpan_password'])->name('simpan.password');

    Route::resource('cabang', CabangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('storage', StorageController::class);
    Route::resource('config', ConfigController::class);
    Route::get('/profil', function () {
        $title = 'Profil';
        return view('profil', compact('title'));
    });
});
