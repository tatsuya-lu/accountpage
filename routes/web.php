<?php

use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});

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

//入力フォームページ
Route::get('/contact', [\App\Http\Controllers\ContactsController::class, 'index'])->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', [\App\Http\Controllers\ContactsController::class, 'confirm'])->name('contact.confirm');
//送信完了フォームページ
Route::post('/contact/thanks', [\App\Http\Mail\ContactsController::class, 'send'])->name('contact.send');