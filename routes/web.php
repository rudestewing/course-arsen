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
    return redirect()->route('course.index');
});
Route::get('/home', function() {
    return redirect()->route('course.index');
})->name('home');

Auth::routes();


Route::middleware(['auth'])->group(function() {
    Route::get('/course/{folderName?}', 'CourseController@index')->name('course.index')->where('folderName', '(.*)');
    Route::get('show-course/{string}', 'CourseController@show')->name('course.show')->where('string', '(.*)');
    Route::get('/storage/{path}', 'StorageController@access')->name('storage.access')->where('path', '(.*)');
    Route::get('/download-storage/{path}', 'StorageController@download')->name('storage.download')->where('path', '(.*)');
});