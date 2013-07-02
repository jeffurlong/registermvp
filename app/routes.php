<?php
View::share('_title', 'MVP Registration | Refreshingly simple online registration');
View::share('_description', 'Stop erroring');



// == [ ACCOUNTS ] =============================================================
Route::group(array('domain' => '{org}.'.Config::get('app.domain'), 'before' => 'org.setup'), function()
{
    Route::get('/', function($org)
    {
        return View::make(Session::get('org.template') ?: 'org.home', array(
            'about'     => nl2br(DB::table('org')->select('v')->whereK('description')->first()->v),
            'events'    => array(),
            'has_hero'  => true
        ));

    });

    Route::get('setup', function()
    {

        return Redirect::to('org/signin');
    });

    Route::get('org/signin', function()
    {
        die('signin');
    });
});

// == [ WWW ] ==================================================================
Route::get('/', function()
{
    return View::make('www.home');
});

Route::get('legal', function()
{
    return View::make('www.legal');
});


