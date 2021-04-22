<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
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
});


Auth::routes();
Route::get('/home', 'HomeController@index');

Route::group(['domain' => 'localhost:4200/#/'], function () {
  Route::get('verification/{token}', 'Auth\RegisterController@verify')->name('register.verify');
});

  
