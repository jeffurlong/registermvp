<?php

Route::group(array('prefix' => 'admin', 'before'=>'auth'), function()
{
    Route::get('/', function()
    {
        return Redirect::to('admin/dashboard');
    });

    Route::get('dashboard', function()
    {
        return View::make('admin.dashboard');
    });

    // == [ PAGES ] ============================================================
    Route::controller('pages', 'PagesController');
    /*
    Route::get('pages', 'PagesController@index');

    Route::get('pages/create', 'PagesController@create');

    Route::post('pages/create', 'PagesController@store');

    Route::get('pages/{id}/edit', 'PagesController@edit');

    Route::put('pages/{id}/edit', 'PagesController@update');

    Route::delete('pages/{id}', 'PagesController@destroy');
*/
    // == [ SETTINGS ] =========================================================
    Route::controller('settings', 'SettingsController');

});
