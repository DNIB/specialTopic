<?php

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

// use Illuminate\Routing\Route;
// use Illuminate\Support\Facades\Route; 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//middleware auth 使未登入者導向登入頁面
Route::resource('Userinput', 'UserinputController')->middleware('auth');

Route::get('/dataCalculate', 'DataCalculateController@index')->middleware('auth');

Route::get('/showChar', 'DataCalculateController@showChar')->middleware('auth');

Route::get('/showSpendChar', 'DataCalculateController@showSpendChar')->middleware('auth');

Route::resource('userself', 'UserSelfController')->middleware('auth');
