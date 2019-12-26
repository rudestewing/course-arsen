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

Route::middleware(['auth'])->group(function() {
    Route::get('/course', 'CourseController@index')->name('course.index');
    Route::get('/course/show/{folderName}', 'CourseController@show')->name('course.show');
});

Route::get('/password', function() {
    return \Hash::make('susujandam4h4L');
});