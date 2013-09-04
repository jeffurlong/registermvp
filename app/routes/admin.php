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

    Route::get('pages', function()
    {
        return View::make('admin.pages', array(
            'pages' => Page::orderBy('updated_at', 'desc')->get()
        ));
    });

});
