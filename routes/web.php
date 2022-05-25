<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'IndexController@welcome');

Route::get('/create','IndexController@createNewScheme');

Route::get('/generate/{color}/{w}/{h}','IndexController@home');

Route::post('/generate','IndexController@generate');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','HomeController@userProfileRedirect');
Route::get('/profile/{ProfileName}','HomeController@userProfile')->name('profile');
Route::get('/profile/{ProfileName}/{schemeId}','HomeController@loadScheme')->name('loadScheme');
Route::get('/delete/{schemeId}','HomeController@deleteScheme')->name('deleteScheme');

Route::get('/search/last','IndexController@searchView');


Route::get('/ajax','AjaxController@index')->name('ajax');
Route::get('/ajax/{schemeId}/{value}','AjaxController@rateSchema');
Route::get('/save/access','AjaxController@redAccess');

Route::post('/save', "HomeController@saveScheme")->name('save');
//Route::post('/save/access/{schemeId}', "HomeController@redAccess");
Route::any('/search','IndexController@search')->name('search');

