<?php

use App\Http\Controllers\CategoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[CategoryController::class,'index'])->name('/');

Route::post('/save-category',[CategoryController::class,'saveCategory'])->name('save-category');
Route::get('get-all-category',[CategoryController::class,'getAllCategory'])->name('get-all-category');
Route::get('delete-category/{id}',[CategoryController::class,'deleteCategory']);
Route::get('edit-category/{id}',[CategoryController::class,'editCategory']);
Route::post('update-category/{id}',[CategoryController::class,'updateCategory']);

