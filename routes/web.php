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
    'middleware' => 'auth'
],function(){
    Route::group([
        'prefix' => 'user',
        'namespace' => 'User'
    ],function(){
        Route::get('',[
            'uses' => 'UserController@index',
            'as' => 'user'
        ]);
        Route::get('create',[
            'uses' => 'UserController@create',
            'as' => 'user.create'
        ]);
        Route::get('edit/{id}',[
             'uses' => 'UserController@edit',
             'as' => 'user.edit'
        ]);
        Route::post('create',[
            'uses'=> 'UserController@doCreate',
            'as' => 'user.create.do'
        ]);
        Route::post('edit/{id}',[
            'uses' => 'UserController@doEdit',
            'as' => 'user.edit.do'
        ]);
    });
    Route::group([
        'prefix' => 'disaster',
        'namespace' => 'Disaster'
    ],function(){
        Route::get('',[
            'uses' => 'DisasterController@index',
            'as' => 'disaster'
        ]);
        Route::get('create',[
            'uses' => 'DisasterController@create',
            'as' => 'disaster.create'
        ]);
        Route::post('create',[
            'uses' => 'DisasterController@doCreate',
            'as' => 'disaster.create.do'
        ]);

        Route::get('edit/{id}',[
            'uses' => 'DisasterController@edit',
            'as' => 'disaster.edit'
        ]);
        Route::post('edit/{id}',[
            'uses' => 'DisasterController@doEdit',
            'as' => 'disaster.edit.do'
        ]);
        Route::post('using',[
            'uses' => 'DisasterController@using',
            'as' => 'disaster.using'
        ]);
    });

    Route::group([
        'prefix' => 'location',
        'namespace' => 'Location'
    ],function(){
        Route::get('/{id}',[
            'uses' => 'LocationController@index',
            'as' => 'location'
        ])->where('id','[0-9]+');
        Route::get('/{id}/create',[
            'uses' => 'LocationController@create',
            'as' => 'location.create'
        ])->where('id','[0-9]+');

        Route::get('/type',[
            'uses' => 'LocationTypeController@index',
            'as' => 'location.type'
        ]);
        Route::get('/type/create',[
            'uses' => 'LocationTypeController@create',
            'as' => 'location.type.create'
        ]);
        Route::post('/type/create',[
            'uses' => 'LocationTypeController@doCreate',
            'as' => 'location.type.create.do'
        ]);
        Route::get('/type/edit/{id}',[
            'uses' => 'LocationTypeController@edit',
            'as' => 'location.type.edit'
        ]);
        Route::post('/type/edit/{id}',[
            'uses' => 'LocationTypeController@doEdit',
            'as' => 'location.type.edit.do'
        ]);

        Route::post('/type/delete',[
            'uses' => 'LocationTypeController@delete',
            'as' => 'location.type.delete.do'
        ]);

    });


});




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
        Route::group([
            'prefix' => 'profile'
        ],function(){
            Route::get('',[
                'uses' => 'ProfileController@index',
                'as' => 'auth.profile'
            ]);
            Route::post('',[
                'uses' => 'ProfileController@update',
                'as' => 'auth.profile.update'
            ]);
        });
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
