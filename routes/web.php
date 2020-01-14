<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

// Route::get('/', ['uses' => 'AppointmentsController@index', 'as' => 'index']);

// Route::get('/doctors/datatable', ['uses' => 'DoctorsController@dataTable', 'as' => 'doctors.datatable']);
// Route::get('/doctors', ['uses' => 'DoctorsController@index', 'as' => 'doctors.index']);
// Route::get('/doctors/create', ['uses' => 'DoctorsController@create', 'as' => 'doctors.create']);
// Route::post('/doctors/store', ['uses' => 'DoctorsController@store', 'as' => 'doctors.store']);
// Route::post('/doctors/update/{id}', ['uses' => 'DoctorsController@update', 'as' => 'doctors.update']);
// Route::get('/doctors/delete/{id}', ['uses' => 'DoctorsController@delete', 'as' => 'doctors.delete']);
// Route::get('/doctors/edit/{id}', ['uses' => 'DoctorsController@edit', 'as' => 'doctors.edit']);

// Route::get('/patients/datatable', ['uses' => 'PatientsController@dataTable', 'as' => 'patients.datatable']);
// Route::get('/patients', ['uses' => 'PatientsController@index', 'as' => 'patients.index']);
// Route::get('/patients/create', ['uses' => 'PatientsController@create', 'as' => 'patients.create']);
// Route::post('/patients/{store', ['uses' => 'PatientsController@store', 'as' => 'patients.store']);
// Route::post('/patients/update/{id}', ['uses' => 'PatientsController@update', 'as' => 'patients.update']);
// Route::get('/patients/delete/{id}', ['uses' => 'PatientsController@delete', 'as' => 'patients.delete']);
// Route::get('/patients/edit/{id}', ['uses' => 'PatientsController@edit', 'as' => 'patients.edit']);

Route::group(['middleware' => ['auth']], function ($router) {
    Route::get('/users',
    [
        'uses' => 'UsersController@index',
        'as' => 'users.index'
    ]
    );
    Route::get('/users/create',
        [
            'uses' => 'UsersController@create',
            'as' => 'users.create'
        ]
    );
    Route::post('/users/store',
        [
            'uses' => 'UsersController@store',
            'as' => 'users.store'
        ]
    );
    Route::post('/users/update/{id}',
        [
            'uses' => 'UsersController@update',
            'as' => 'users.update'
        ]
    );
    Route::get('/users/delete/{id}',
        [
            'uses' => 'UsersController@delete',
            'as' => 'users.delete'
        ]
    );
    Route::get('/users/edit/{id}',
        [
            'uses' => 'UsersController@edit',
            'as' => 'users.edit'
        ]
    );
    Route::get(
        '/users/datatable',
        [
            'uses' => 'UsersController@dataTable',
            'as' => 'users.datatable'
        ]
    );
});
