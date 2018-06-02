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

// PagesController

Route::get('/', 'PagesController@index');

Route::get('/customers', 'PagesController@customers');
//Route::get('/articles', 'PagesController@articles');
Route::get('/orders', 'PagesController@orders');
Route::get('/purchase', 'PagesController@purchase');

// ArticlesController (resource)
Route::resource('/articles', 'ArticlesController');
// CategoriesController (resource)
Route::resource('/categories', 'CategoriesController');
Route::get('jquery-tree-view', array('as'=>'jquery.treeview','uses'=>'CategoriesController@treeView'));