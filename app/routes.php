<?php
View::share('_title', 'MVP Registration | Refreshingly simple online registration');
View::share('_description', 'Stop erroring');

Route::controller('org', 'OrgController');

Route::get('/', function()
{
    if ( ! subdomain()) {
        return View::make('www.home');
    }

    return Redirect::to('org');
});

Route::get('legal', function()
{
    die('www legal');
});

Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', function()
    {
        die('admin index');
    });

    Route::get('my-account', function()
    {
        die('admin my-account');
    });

    Route::controller('event', 'AdminEventController');
});

 Route::group(array('prefix' => 'member'), function()
{
    Route::get('/', function()
    {
        die('member index');
    });

    Route::controller('event', 'MemberEventController');
});


