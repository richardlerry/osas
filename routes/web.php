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
    return redirect(url('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','dashboard@index');
Route::get('/sanction','sanction@index');

Route::resource('sanctionTitle','sanctionTitle');
Route::resource('officeDesignation','officeDesignation');
Route::resource('student','student');
Route::resource('course','course');
Route::resource('assistance','assistance');
Route::resource('assistanceTitle','assistanceTitle');
Route::resource('sanction','sanction',[
    'names' => [
        'index' => 'sanction',
        'show' => 'sanction',
    ]
]);
