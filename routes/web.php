<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    if (auth()->user()){
        return view('home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('entreprises/export/', 'EntrepriseController@export')->name('entreprises.export');
Route::resource('entreprises', 'EntrepriseController');


Route::get('employes/export/', 'EmployeController@export')->name('employes.export');
Route::resource('employes', 'EmployeController');
Route::get('entreprises/{entreprise}/employes', 'EmployeController@index')->name('employes.entreprise');
