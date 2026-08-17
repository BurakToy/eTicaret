<?php

use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/a', function () {
    $id=1;
    $category = category::find($id);
    $products = $category->getProduct;
    return dd($products);
});

Route::get('/b', function () {
    return view('layout.app');
});
Route::get('/c', function () {
    return view('layout.app2');
});
Route::get('/d', function () {
    return view('layout.app3');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
