<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//-------------------------------------------------
Route::get('student','StudentController@index');
Route::post('studenta','StudentController@store');
Route::get('student/{id}/edit', 'StudentController@edit')->name('student.edit');
Route::post('student/update', 'StudentController@update')->name('student.update');
Route::get('student/{id}/delete', 'StudentController@destroy')->name('student.delete');


Route::get('/pagination', 'StudentController@index2');  // this is for show page and data from table
Route::get('pagination/fetch_data', 'StudentController@fetch_data');  //this is for Paginate

//search 
Route::get('/a', function () {
    return view('search.app');
});
Route::get('/search','StudentController@search');
Route::get('/member/{id}','StudentController@viewmember');
Route::get('/ajax','StudentController@index3');
Route::get('student/{id}/showview', 'StudentController@showview'); 
//view
Route::post('stuview','StudentController@stuview');
// change Page by Ajax
Route::get('/ajax/GetContent', array(
    'uses'  =>  'StudentController@index3'
  ));
  Route::get('/paginatio', array(
    'uses'  =>  'StudentController@index4'
  ));
//   Route::get('/paginatio', 'StudentController@index4');

Route::get('/sch', function () {
    return view('student.search');
});


Route::get('/sc', function () {
    return view('student.search');
});

//this is rout and Ajax call our function in controller by this
Route::get('/sdch','StudentController@search1');















// paginate Ajax
Route::get('posts', 'StudentController@index1');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
