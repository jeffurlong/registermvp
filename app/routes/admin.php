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

    Route::get('my-account', function()
    {
        die('admin my-account');
    });

    Route::controller('event', 'AdminEventController');
});
