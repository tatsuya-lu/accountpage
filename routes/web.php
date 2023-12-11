<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AdminInquiryController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

//入力フォームページ
Route::get('/contact', [\App\Http\Controllers\ContactsController::class, 'index'])->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', [\App\Http\Controllers\ContactsController::class, 'confirm'])->name('contact.confirm');
//送信完了フォームページ
Route::post('/contact/thanks', [\App\Http\Controllers\ContactsController::class, 'send'])->name('contact.send');

Route::get('/admin/login', function () {
    return view('adminLogin');
})->middleware('guest:admin');

Route::post('/admin/login', [\App\Http\Controllers\LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/logout', [\App\Http\Controllers\LoginController::class, 'adminLogout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware('auth:admin')->name('admin.dashboard');

Route::get('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegisterForm'])->middleware('auth:admin');

Route::post('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegister'])->middleware('auth:admin')->name('admin.register');

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // 既存のアカウント一覧表示
    Route::get('/table', [TableController::class, 'adminTable'])->name('admin.table');

    // アカウント編集フォーム表示
    Route::get('/table/{user}/edit', [TableController::class, 'edit'])->name('admin.table.edit');

    // アカウント編集処理
    Route::put('/table/{user}', [TableController::class, 'update'])->name('admin.table.update');

    // アカウント削除処理
    Route::delete('/table/{user}', [TableController::class, 'destroy'])->name('admin.table.destroy');

    // お問い合わせ一覧表示
    Route::get('/inquiry', [AdminInquiryController::class, 'index'])->name('admin.inquiry.index');

    // お問い合わせ編集フォーム表示
    Route::get('/inquiry/{inquiry}/edit', [AdminInquiryController::class, 'edit'])->name('admin.inquiry.edit');

    // お問い合わせ編集処理
    Route::put('/inquiry/{inquiry}', [AdminInquiryController::class, 'update'])->name('admin.inquiry.update');

    // お問い合わせ削除処理
    Route::delete('/inquiry/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('admin.inquiry.destroy');
});

