<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JenreController;
use App\Http\Controllers\ContactController;
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
//一覧画面
Route::get('/posts', [PostController::class, 'index']);
//投稿作成画面
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
//{event=対象のid}詳細画面
Route::get('/posts/{event}', [PostController::class, 'show']);
//edit画面
Route::get('/posts/{event}/edit', [PostController::class, 'edit']);
Route::put('/posts/{event}', [PostController::class, 'update']);
Route::delete('/posts/{event}', [PostController::class, 'delete']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//ジャンル別
Route::get('/jenres/{jenre}', [JenreController::class, 'index']);

//入力フォームページ
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
//送信完了ページ
Route::post('/contact/thanks', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';