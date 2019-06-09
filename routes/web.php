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

Route::get('ariesocr','UploadController@index')->name('ariesocr.root');

Route::get('ariesocr/rest/url','UploadController@link')->name('ariesocr.url.upload');


Route::post('ariesocr/rest/upload','UploadController@upload')->name('ariesocr.upload');

