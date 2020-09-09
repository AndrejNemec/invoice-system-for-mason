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
    return view('home');
})->name('home');

Route::resource('/catalog', 'CatalogController');
Route::resource('/unit', 'UnitController');
Route::resource('/item', 'ItemController');
Route::resource('/project', 'ProjectController');

Route::put('/project/{id}/type/{type}/invoice', 'ProjectController@invoice')->name('project.type.invoice');
Route::get('/project/{id}/type/{type}', 'ProjectController@show')->name('project.type');

Route::put('/project/items/{id}/update', 'ProjectItemController@update')->name('project.items.update');
Route::post('/project/items/add', 'ProjectItemController@store')->name('project.items.add');
Route::delete('/project/items/{id}/remove', 'ProjectItemController@destroy')->name('project.items.remove');

Auth::routes();

