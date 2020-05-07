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
        'prefix' => 'contact',
        'namespace' => 'Contact'
    ],function(){
        Route::get('',[
            'uses' => 'ContactController@index',
            'as' => 'contact'
        ]);
        Route::get('create',[
            'uses' => 'ContactController@create',
            'as' => 'contact.create'
        ]);
        Route::post('create',[
            'uses' => 'ContactController@doCreate',
            'as' => 'contact.create.do'
        ]);
        Route::get('edit/{id}',[
            'uses' => 'ContactController@edit',
            'as' => 'contact.edit'
        ]);
        Route::post('edit/{id}',[
            'uses' => 'ContactController@doEdit',
            'as' => 'contact.edit.do'
        ]);
        Route::post('delete',[
            'uses' => 'ContactController@doDelete',
            'as' => 'contact.delete.do'
        ]);

        Route::group([
            'prefix' => 'rest'
        ],function(){
            Route::get('search',[
                'as' => 'contact.rest.search',
                'uses' => 'ContactRestController@search'
            ]);
        });
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

        Route::post('/{id}/create',[
            'uses' => 'LocationController@doCreate',
            'as' => 'location.create.do'
        ])->where('id','[0-9]+');

        Route::get('/{disaster_id}/edit/{id}',[
            'uses' => 'LocationController@edit',
            'as' => 'location.edit'
        ])->where('id','[0-9]+')->where('disaster_id','[0-9]+');;

        Route::post('/{disaster_id}/edit/{id}',[
            'uses' => 'LocationController@doEdit',
            'as' => 'location.edit.do'
        ])->where('disaster_id','[0-9]+');

        Route::post('/delete/{id}',[
            'uses' => 'LocationController@doDelete',
            'as' => 'location.delete.do'
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

    Route::group([
        'prefix' => 'observasi',
        'namespace' => 'Observasi'
    ],function(){
        Route::group([
            'middleware' => 'disaster'
        ],function(){
            Route::get('{disaster_id}',[
                'uses' => 'ObservasiController@index',
                'as' => 'observasi'
            ]);
            Route::get('{disaster_id}/create',[
                'uses' => 'ObservasiController@create',
                'as' => 'observasi.create'
            ]);
            Route::post('{disaster_id}/create',[
                'uses' => 'ObservasiController@doCreate',
                'as' => 'observasi.create.do'
            ]);
            Route::get('{disaster_id}/edit/{id}',[
                'uses' => 'ObservasiController@edit',
                'as' => 'observasi.edit'
            ]);
            Route::post('{disaster_id}/edit/{id}',[
                'uses' => 'ObservasiController@doEdit',
                'as' => 'observasi.edit.do'
            ]);
            Route::post('{disaster_id}/delete',[
                'uses' => 'ObservasiController@delete',
                'as' => 'observasi.delete.do'
            ]);
        });
    });

    Route::group([
        'prefix' => 'common',
        'namespace' => 'Common'
    ],function(){
        Route::get('api/state',[
            'uses' => 'AddressApiController@getState',
            'as' => 'common.api.state'
        ]);
        Route::get('api/district',[
            'uses' => 'AddressApiController@getDistrict',
            'as' => 'common.api.district'
        ]);
        Route::get('api/sub-district',[
            'uses' => 'AddressApiController@getSubDistrict',
            'as' => 'common.api.subdistrict'
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
