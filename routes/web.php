<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\TableController;
use Faker\Guesser\Name;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

Route::get('/admin/login', function () {
    return view('adminLogin');
})->middleware('guest:admin');

Route::post('/admin/login', [\App\Http\Controllers\LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/logout',[\App\Http\Controllers\LoginController::class,'adminLogout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware('auth:admin')->name('admin.dashboard');

Route::get('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegisterForm'])->middleware('auth:admin');

Route::post('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegister'])->middleware('auth:admin')->name('admin.register');

// Route::get('/admin/table', [App\Http\Controllers\TableController::class, 'adminTable'])->name('admin.table');

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // 既存のアカウント一覧表示
    Route::get('/table', [TableController::class, 'adminTable'])->name('admin.table');

    // アカウント編集フォーム表示
    Route::get('/table/{user}/edit', [TableController::class, 'edit'])->name('admin.table.edit');

    // アカウント編集処理
    Route::put('/table/{user}', [TableController::class, 'update'])->name('admin.table.update');

    // アカウント削除処理
    Route::delete('/table/{user}', [TableController::class, 'destroy'])->name('admin.table.destroy');
});