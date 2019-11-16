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
    //return view('welcome');
	return view('auth.login');
	//route('login')
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admins', 'AdminsController@index')->name('admins');
Route::get('/admins/add', 'AdminsController@add')->name('admins_add');
Route::post('/admins/proadd', 'AdminsController@proadd')->name('proadd');
Route::get('/admins/editadm/{id}', 'AdminsController@editadm')->name('editadm');
Route::put('/admins/update/{id}', 'AdminsController@update')->name('update');
Route::get('/admins/hapusadm/{id}', 'AdminsController@hapusadm')->name('hapusadm');

Route::get('/forms', 'AdminsController@forms')->name('forms');
Route::get('/admins/addform', 'AdminsController@addform')->name('addform');
Route::post('/admins/addingform', 'AdminsController@addingform')->name('addingform');
Route::get('/admins/hapusform/{id}', 'AdminsController@hapusform')->name('hapusform');
Route::get('/admins/editform/{id}', 'AdminsController@editform')->name('editform');
Route::post('/admins/editingform', 'AdminsController@editingform')->name('editingform');



