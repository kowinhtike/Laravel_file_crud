<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
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
    Route::post("blogs/comment/{id}","addComment")->name("blogs.comment");
});

Route::controller(ContactController::class)->group(function(){
    Route::get('/contact','index')->name("contact.index");
    Route::post('/contact/store',"store")->name("contact.store");
    Route::get('/contact/edit/{id}',"edit")->name("contact.edit");
    Route::post('/contact/update',"update")->name("contact.update");
    Route::post('/contact/delete/{id}',"delete")->name("contact.delete");
});

Route::get('/users/store',[UserController::class,"store"]);