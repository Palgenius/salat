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

Route::get('/', function () {
    return view('welcome');
})->name('base');

Route::get('/salat','salat@index')->name('salat');
Route::get('/admin','salat@admin')->name('admin');
Route::post('/submit','salat@submit')->name('submit');
