<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::controller(BlogController::class)->group(function(){
    Route::get('/','index')->name("blogs.index");
    Route::get('/blogs/create','create')->name('blogs.create');
    Route::post('/blogs/store',"store")->name("blogs.store");
    Route::get('blogs/{id}',"show")->name("blogs.show");
    Route::get('blogs/edit/{id}',"edit")->name("blogs.edit");
    Route::post('blogs/update/{id}',"update")->name("blogs.update");
    Route::get('blogs/delete/{id}',"destroy")->name("blogs.destroy");
});
