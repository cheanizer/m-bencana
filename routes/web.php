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

Route::get('/', function () {
    return view('landing.index');
})->name('landing');

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth'
],function(){
    Route::post('login',[
        'uses' => 'LoginController@authenticate',
        'as' => 'auth.authenticate'
    ]);
    Route::group([
        'middleware'=>'auth'
    ],function(){
        Route::post('logout',[
            'as' => 'auth.logout',
            'uses' => 'LoginController@logout'
        ]);
    });
});





Route::get('/master',function() {
    return view('master.masterlayout');
})->name('master');

Route::get('/login',function() {
    return view('auth.login');
})->name('login');

Route::get('dashboard',function(){
    return view('dashboard.index');
})->name('dashboard');
