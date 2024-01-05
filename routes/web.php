<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class)->only(['index', 'show']); // indico i metodi che utilizzo nel controller cosi' da togliere i routing non necessari dalla lista

Route::resource('books.reviews', ReviewController::class)->scoped(['reviews' => 'book'])->only('create', 'store');
