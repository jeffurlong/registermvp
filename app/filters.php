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
	if (Config::get('app.secure') and ! Request::secure()) {
        header('Location: https://'.Config::get('app.domain').Request::path());
        exit;
    }

    if (Input::has('_token') and Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }

    // If there's no subdomain, we're not at an org site so we're done.
    if ( ! subdomain()) {
        return null;
    }

    // If the org has already been stored in the session, we're done.
    if (Session::has('org')) {
        return null;
    }

    // If the subdomain doesn't match one of our registered orgs, its a 404
    if ( ! in_array(subdomain(), Config::get('app.subdomains')) ) {
        App::abort(404);
    }

    // If we can't get the org data from the DB we have a problem.
    // TODO: Log and send an error
    if ( ! $org =  Organization::getSessionData()) {
        App::abort(404);
    }

    // Store the essential org data
    Session::put('org', $org);

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

Route::filter('org.setup', function() {

    if ( ! Session::get('org.payment_processor')) {
        die(Request::is('setup'));
        return (Request::is('setup')) ? Redirect::to('org/setup') : Redirect::to('org/soon');
    }


});
