<?php
Route::group(array('domain' => '{org}.'.Config::get('app.domain')), function()
{
    Route::get('/', function($org)
    {
        if ( ! Session::get('org.payment_processor')) {
            return View::make('org.soon');
        }

        return View::make('org.home');
    });

    Route::get('setup', function()
    {
        return (Session::get('org.payment_processor')) ? Redirect::to('org.signin') : Redirect::to('org.setup');
    });
});

Route::get('/', function()
{
	return View::make('main.home');
});
