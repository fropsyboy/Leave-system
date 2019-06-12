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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/leave', 'HomeController@leave')->name('leave');

Route::get('/delete_leave/{id}', 'HomeController@delete_leave')->name('delete_leave');

Route::post('/leave', 'HomeController@leave_add')->name('leave_add');\

Route::get('/settings', 'HomeController@settings')->name('settings');

Route::get('/approval', 'HomeController@approval')->name('approval');

Route::get('/approve_leave/{id}', 'HomeController@approve_leave')->name('approve_leave');

Route::get('/reject_leave/{id}', 'HomeController@reject_leave')->name('reject_leave');

Route::group(['middleware' => ['role:administrator']], function() {

    Route::get('/users',  'HomeController@user')->name('user');

    Route::post('/users', 'HomeController@user_add')->name('user_add');

    Route::get('/users/{id}/{status}', 'HomeController@chgStatus')->name('chgStatus');

});



