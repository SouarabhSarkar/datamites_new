<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\AccountVerification;
use App\Models\User;
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
    return view('/welcome');
});

Route::post('/register', 'App\Http\Controllers\UserController@RegisterUser')->name('RegisterUser');

Route::get('/registeration', 'App\Http\Controllers\UserController@registeration')->name('registeration');

Route::post('/login','App\Http\Controllers\UserController@loginUser')->name('loginUser');

Route::get('/edit/user/{id}','App\Http\Controllers\UserController@EditUser')->name('edit');

Route::post('/update/user/{id}','App\Http\Controllers\UserController@UpdateUser')->name('update');

Route::post('/delete/user/{id}','App\Http\Controllers\UserController@DeleteUser')->name('delete');

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');

Route::get('/admin','App\Http\Controllers\UserController@AdminPanel')->name('admin');

Route::get('/download/user/pdf','App\Http\Controllers\UserController@downloadpdf')->name('downloadpdf');
Route::post('/user','App\Http\Controllers\Auth\RegisterController@register');