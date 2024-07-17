<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::match(['get', 'post'], '/main/perpus', [BookController::class, 'perpus'])->name('main.perpus');

Route::get('/', function () {
    return view('/main/index');
});

Route::get('/dashboard', [BookController::class, 'layout'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('books', BookController::class)->middleware('auth');
Route::resource('books', BookController::class)->middleware(['auth', 'admin']);
require __DIR__.'/auth.php';


Route::post('/books/search', [BookController::class, 'search'])->name('books.search');
Auth::routes();

Route::post('/main/search', [BookController::class, 'mainsearch'])->name('main.search');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books/{id}/show', [BookController::class, 'show'])->name('books.show');

Route::get('/books/{id}/pinjam', [BookController::class, 'borrow'])->name('books.borrow');
Route::post('/books/{id}/pinjamval', [BookController::class, 'borrowval']);

Route::get('/main/{id}/pengembalian', [BookController::class, 'return'])->name('main.return');
Route::post('/main/{id}/konfirmasipengembalian', [BookController::class, 'returnconfirm']);

Route::get('/main/{id}/validasipengembalian', [BookController::class, 'returnval'])->name('main.dashboard');




