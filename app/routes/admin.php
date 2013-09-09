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


    Route::get('pages', 'PagesController@index');

    Route::get('pages/{id}/edit', 'PagesController@edit');

    Route::put('pages/{id}/edit', 'PagesController@update');

});
