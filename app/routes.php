<?php
View::share('_title', 'MVP Registration | Refreshingly simple online registration');
View::share('_description', 'Stop erroring');

if ( Session::has('org')) {
    View::share('_org', Session::get('org'));
}

// == [ WWW ] ==================================================================
Route::get('/', function()
{
    return subdomain() ?  Redirect::to('org') : View::make('www.home');
});

Route::get('legal', function()
{
    die('www legal');
});

// == [ ORG ] ==================================================================
Route::controller('org', 'OrgController');

// == [ ADMIN ] ================================================================
Route::group(array('prefix' => 'admin', 'before'=>'auth'), function()
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

// == [ MEMBER ] ==================================================================
Route::group(array('prefix' => 'member', 'before'=>'auth'), function()
{
    Route::get('/', function()
    {
        die('member index');
    });

    Route::controller('event', 'MemberEventController');
});


