<?php
Route::group(array('domain' => '{org}.'.Config::get('app.domain')), function()
{
    Route::get('/', function($org){
        return View::make('org/home');
    });
});

Route::get('/', function()
{
	return View::make('main/home');
});
