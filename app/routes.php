<?php
View::share('_title', function() {
  if (Request::subdomain() and Session::has('org'))
    return Session::get('org.name').' registration by MVP Registration';
  else
    return 'MVP Registration | Refreshingly simple online registration';
});
View::share('_description', 'Description');
/*
View::share('_description', function() {
  if (Request::subdomain() and Session::has('org'))
    return Session::get('org.name').' online registration with MVP Registration. MVP Registration brings a refreshingly simple approach to online registrations.';
  else
    return 'Accept payments and manage online registrations. MVP Registration brings a refreshingly simple approach to online registration for your organization.';
});
*/
if ( Session::has('org')) {
  View::share('_org', function() {
    return Session::get('org');
  });
}


Route::group(array('domain' => '{org}.'.Config::get('app.domain')), function()
{
    View::share('_title', function () {
        return (Session::has('org')) ? Session::get('org.name').' registration by MVP Registration.' : 'MVP Registration | Refreshingly simple online registration';
    });

    Route::get('/', function($org)
    {
        if ( ! Session::get('org.payment_processor')) {
            return View::make('org.soon');
        }

        $template = Session::get('org.template') ?: 'org.home';

        return View::make($template, array(
            'about'     => nl2br(DB::table('org')->select('v')->whereK('description')->first()->v),
            'events'    => array(),
            'has_hero'  => true
        ));

    });

    Route::get('setup', function()
    {
        return (Session::get('org.payment_processor')) ? Redirect::to('org.signin') : Redirect::to('org.setup');
    });
});

View::share('_title', 'MVP Registration | Refreshingly simple online registration');

Route::get('/', function()
{
	return View::make('www.home');
});

Route::get('legal', function()
{
    return View::make('www.legal');
});

