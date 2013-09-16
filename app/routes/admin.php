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

    // == [ PAGES ] ============================================================
    Route::get('pages', 'PagesController@index');

    Route::get('pages/create', 'PagesController@create');

    Route::post('pages/create', 'PagesController@store');

    Route::get('pages/{id}/edit', 'PagesController@edit');

    Route::put('pages/{id}/edit', 'PagesController@update');

    Route::delete('pages/{id}', 'PagesController@destroy');

    // == [ SETTINGS ] =========================================================
    Route::get('settings/general', function()
    {
        return View::make('admin.settings.general', array('org' => Org::all(), 'states' => form_states()));
    });

    Route::put('settings/general', function()
    {
        try
        {
            Org::update(Input::except('_method'));
        }
        catch (Exception $e)
        {
            return Redirect::to('/admin/settings/general')->with('error', 'An error has occured');
        }

        return Redirect::to('/admin/settings/general')->with('message', 'Your settings have been saved');
    });

    Route::get('settings/payments', function()
    {
        $data = Org::getAuthnetCredentials();

        return View::make('admin.settings.payments', array(
            'client_id' => Config::get('payments.stripe.client_id'),
            'authnet_api_login' => $data['authnet_api_login'],
            'authnet_transaction_key' => $data['authnet_transaction_key'],
        ));
    });

    Route::put('settings/payments', function()
    {
        try
        {
            Org::update(Input::except('_method'));
            Session::put('org', Org::getSessionData());
        }
        catch (Exception $e)
        {
            return Redirect::to('/admin/settings/payments')->with('error', 'An error has occured');
        }

        return Redirect::to('/admin/settings/payments')->with('message', 'Your settings have been saved');
    });

    Route::put('settings/payments/json', function()
    {
        try
        {
            Org::update(Input::except('_method'));
            Session::put('org', Org::getSessionData());
        }
        catch (Exception $e)
        {
            return Response::json(array('result' => 'error'));
        }

        return Response::json(array('result' => 'success'));
    });

    Route::get('settings/notifications', function()
    {
        return View::make('admin.settings.notifications', array('subscriptions' => Subscription::where('type', 'order')->get()));
    });



    Route::post('settings/notifications/create', function()
    {
        $result = 'error';
        $sub = new Subscription(Input::only('type','address'));

        if ($sub->save())
        {
            $result = 'success';

            Session::flash('message', 'Your notification has been saved');
        }

        return Response::json(array('result' => $result));
    });



});
