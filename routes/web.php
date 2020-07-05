<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', function () {
    return view('home');
});

/*
 * Faking a login Route
 */
Route::get('/login/{id}', 'FakeLoginController@login');

/*
 * Users Routes
 */
Route::get('/users/delete', 'UserController@delete');
Route::resource('users', 'UserController');

/*
 * Entity Routes
 */
Route::get('/entities/delete', 'EntityController@delete');
Route::resource('entities', 'EntityController');

/*
 * Resource Routes
 */
Route::get('/resources/delete', 'ResourceController@delete');
Route::resource('resources', 'ResourceController');



