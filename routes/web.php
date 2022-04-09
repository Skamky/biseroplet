<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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
Route::get('/','IndexController@start');

Route::get('/generate/{color}/{w}/{h}','IndexController@home');

Route::post('/generate','IndexController@generate');
Route::get('/profile/{ProfileName}/{schemeId}','HomeController@loadScheme')->name('loadScheme');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{ProfileName}','HomeController@userProfile')->name('profile');
Route::post('/save', "HomeController@saveScheme")->name('save');

