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
    return View::make('www.legal');
});


// == [ ORG ] ==================================================================
Route::group(array('prefix' => 'org', 'before' => 'org'), function()
{
    Route::get('/', function()
    {
        $template = Session::get('org.template') ?: 'org.home';

        $about =    '';//DB::table('org')->select('v')->whereK('description')
                        //->first()->v;

        return View::make($template, array(
            'about'     => nl2br($about),
            'events'    => array()
        ));
    });

    Route::get('login', function()
    {
        return View::make('org.login', array('email' => Input::old('email'), 'message' => Session::get('message')));
    });

    Route::post('login', function()
    {
        if (Auth::attempt(array('username' => Input::get('email'), 'password' => Input::get('password'))))
        {
            return Redirect::intended('admin');
        }

        return Redirect::to('org/login')->with('message','Invalid')->withInput();
    });

    Route::get('forgot', function()
    {
        if ( Session::has('success')) {
            return Redirect::to('org/logout')->with('reset', true);
        }

        return View::make('org.forgot');
    });


    Route::post('forgot', function()
    {
        return Password::remind(array('username' => Input::get('email')));
    });

    Route::get('signup', function()
    {
        return View::make('org.signup');
    });

    Route::get('logout', function()
    {
        Auth::logout();
        return View::make('org.logout');
    });

});


// == [ ADMIN ] ================================================================
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

// == [ MEMBER ] ==================================================================
Route::group(array('prefix' => 'member', 'before'=>'auth'), function()
{
    Route::get('/', function()
    {
        die('member index');
    });

    Route::controller('event', 'MemberEventController');
});


