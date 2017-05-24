<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/404', 'HomeController@pageNotFound')->name('404');

Route::group(['prefix' => 'api/suggest'], function () {
    Route::get('/schools', 'SchoolController@search')->name('school-search');
    Route::get('/first-name', 'PupilController@suggestName')->name('pupil-suggest-name');
    Route::get('/city', 'CityController@search')->name('city-search');
});

Route::get('/register', 'PupilController@showRegistrationFrom')->name('pupil-register-form');
Route::post('/register', 'PupilController@register')->name('pupil-register');
Route::get('/register/success', 'PupilController@success')->name('pupil-register-success'); //todo


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'school', 'middleware' => 'can:any,App\Model\School'], function () {
        Route::get('/', 'SchoolController@index')->name('school-list');
        Route::get('add', 'SchoolController@showAddForm')->name('school-show-add-form');
        Route::post('add', 'SchoolController@add')->name('school-add');
        Route::get('/{id}', 'SchoolController@showEditForm')->name('school-show-edit-form');
        Route::post('/{id}', 'SchoolController@edit')->name('school-edit');
        Route::delete('/{id}', 'SchoolController@remove')->name('school-delete');
    });

    Route::group(['prefix' => 'pupil'], function () {
        Route::get('/list', 'PupilController@index')->name('pupil-list');
        Route::post('/confirm', 'PupilController@confirm')->name('pupil-confirm');
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('/', 'EventController@index')->name('event-list');
        Route::get('/add', 'EventController@showAddForm')->name('event-show-add-form');
        Route::post('/add', 'EventController@add')->name('event-add');
        Route::get('/{id}', 'EventController@showEditForm')->name('event-show-edit-form');
        Route::post('/{id}', 'EventController@edit')->name('event-edit');
        Route::delete('/{id}', 'EventController@remove')->name('event-remove');

        // current
        Route::group(['prefix' => 'current'], function () {
            Route::get('/', 'EventController@currentList')->name('event-current-list');
            //todo
            Route::get('/{id}', 'EventController@classes')->name('event-classes');
            Route::get('/{id}/{class}', 'EventController@pupilsByClass')->name('event-pupils-by-class');
            Route::post('/{id}/{class}', 'EventController@massUpdate')->name('event-mass-update');
        });
    });

    Route::group(['prefix' => 'user', 'middleware' => 'can:any,App\User'], function (){
        Route::get('/', 'UserController@index')->name('user-list');
        Route::get('/add', 'UserController@showAddForm')->name('user-show-add-form');
        Route::post('/add', 'UserController@add')->name('user-add');
        Route::get('/{id}', 'UserController@showEditForm')->name('user-show-edit-form');
        Route::post('/{id}', 'UserController@edit')->name('user-edit');
    });
});


