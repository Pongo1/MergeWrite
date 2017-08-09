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
Route::get('page-not-found',[
    'uses'=>'ErrorController@showError',
    'as'=>'page.unavailable']);

Route::get('/', function () {
    return view('welcome');
});

//---------------------------------FOREIGN LINKS----------------------------------
Route::get('latest-pieces',[
  'uses'=>'PublishesController@showNew',
  'as'=>'pieces.latest','middleware'=>'auth']);
Route::get('add-english-tip/{key}/{deviceName}/{text}','PieceController@addEnglishTipItem');
Route::get('device-show','PieceController@showSession');
Route::get('device-clear','PieceController@clearDeviceBag');
Route::get('show-my-devices','PieceController@devicesInUse');
Route::get('save-devices','PieceController@Trial');
//-----------------------------------------------------------------------------





//--------------------------------------------------BBOOKLINKS---------------

Route::get('edit-page/{page_id}',[
  'uses'=>'BookController@editPage',
  'as'=>'page.edit','middleware'=>'auth']);

Route::get('show-page/{page_id}',[
  'uses'=>'BookController@showPage',
  'as'=>'page.show','middleware'=>'auth']);

Route::get('book-view/{book_id}',[
  'uses'=>'BookController@showBookView',
  'as'=>'book.view','middleware'=>'auth']);

Route::get('edit-book-name/{book_id}',[
'uses'=>'BookController@editBookName',
'as'=>'bookname.edit','middleware'=>'auth']);

Route::get('create-book',[
  'uses'=>'BookController@createBook',
  'as'=>'book.create','middleware'=>'auth']);
 Route::get('book-delete/{book_id}',[
    'uses'=>'BookController@deleteBook',
    'as'=>'book.delete','middleware'=>'auth']);

Route::get('chapter-view/{book_id}/{chapter_id}',[
    'uses'=>'BookController@showChapter',
    'as'=>'chapter.view','middleware'=>'auth']);

Route::get('chapter-edit/{book_id}/{chapter_id}',[
    'uses'=>'BookController@editChapterName',
    'as'=>'chaptername.edit','middleware'=>'auth']);

Route::get('create-chapter/{book_id}',[
    'uses'=>'BookController@createChapter',
    'as'=>'chapter.create','middleware'=>'auth']);

Route::get('chapter-delete/{chapter_id}',[
  'uses'=>'BookController@deleteChapter',
  'as'=>'chapter.delete','middleware'=>'auth']);

Route::get('create-page/{chapter_id}',[
  'uses'=>'BookController@createPage',
  'as'=>'page.create', 'middleware'=>'auth']);

Route::get('page-make',[
  'uses'=>'BookController@makePage',
  'as'=>'page.make','middleware'=>'auth']);

Route::get('page-view',[
    'uses'=>'BookController@showPage',
    'as'=>'page.view','middleware'=>'auth']);

Route::get('page-delete/{page_id}',[
    'uses'=>'BookController@deletePage',
    'as'=>'page.delete','middleware'=>'auth']);

//------------------------------------------------------------------------------


//-----------------------------------------------------------------------------
Auth::routes();

Route::get('show',['uses'=>'NotesController@show','as'=>'show.profile','middleware'=>'auth']);

Route::get('book-show','BookController@show');
Route::get('save-note/{userId}',['uses'=>'NotesController@saveNote','as'=>'save.note','middleware'=>'auth']);

Route::get('make-note',['uses'=>'NotesController@makeNote','as'=>'make.note','middleware'=>'auth']);

Route::get('edit-note/{id}',['uses'=>'NotesController@editNote','as' =>'edit.note','middleware'=>'auth']);

Route::get('see-note/{id}',['uses'=>'NotesController@seeNote','as' =>'see.note','middleware'=>'auth']);

Route::get('delete-note/{id}',['uses'=>'NotesController@deleteNote','as' =>'delete.note','middleware'=>'auth']);

Route::get('/home/{username}', 'HomeController@index')->name('home');
