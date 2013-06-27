<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if (Config::get('app.ssl') and ! Request::secure()) {
        header('Location: https://'.Config::get('app.domain').Request::path());
        exit;
    }

    if (Input::has('_token') and Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }

    // If there's no subdomain, we're not at an org site so we're done. Everything after this
    // applies only to org sites.
    if ( ! Request::subdomain()) {
        return null;
    }


    $org = DB::select('Select * from organization');
    var_dump($org);

    // If the org has already been stored in the session, we're done.
    if (Session::has('org')) {
        return null;
    }

    if ( ! in_array(Request::subdomain(), Config::get('app.subdomains')) ) {
        App::abort(404);
    }

    // If we can't find the Org data, we have a problem. (Consider creating an admin alert)
/*
    if ( ! ($org = Organization::find())) {
        return Response::error('404');
    }
*/

    // Store the essential org data
/*
    Session::put('org', $org->to_array(array(
         'id',
         'name',
        'email',
        'phone',
        'website',
        'theme',
        'template',
        'event_label',
        'event_series_label',
        'event_category_label',
        'event_menu_label',
        'payment_processor'
    )));
*/
    Session::put('org', array(
        'id' => 1,
        'name' => 'Demo',
        'email' => 'demo@demo.com',
        'phone' => '555-555-5555',
        'website' => 'demo.com',
        'theme' => null,
        'template' => null,
        'event_label' => 'Event',
        'event_series_label' => 'Series',
        'event_category_label' => 'Category',
        'event_menu_label' => 'Events',
        'payment_processor' => 'authnet',
    ));

    return null;

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
