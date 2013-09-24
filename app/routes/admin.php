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

    Route::controller('pages', 'PagesController');

    Route::controller('settings', 'SettingsController');

    Route::controller('orders', 'OrdersController');

    Route::controller('customers', 'CustomersController');
});
