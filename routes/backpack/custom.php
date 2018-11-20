<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
//    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('project', 'ProjectCrudController'); // user/project
    CRUD::resource('{project_id}/properties', 'PropertyCrudController'); // user/project/property
    Route::get('dashboard', 'ProjectCrudController@index');
}); // this should be the absolute last line of this file

Route::group(
    [
        'namespace'  => 'App\Http\Controllers',
        'middleware' => 'web',
        'prefix'     => config('backpack.base.route_prefix'),
    ],
    function () {
        // if not otherwise configured, setup the "my account" routes
        if (config('backpack.base.setup_my_account_routes')) {
            Route::get('edit-account-info', 'Auth\MyAccountController@getAccountInfoForm')->name('backpack.account.info');
            Route::post('edit-account-info', 'Auth\MyAccountController@postAccountInfoForm');
        }
    });
