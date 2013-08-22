<?php

Route::group(array('prefix' => 'org', 'before' => 'org'), function()
{
    Route::get('/', function()
    {
        return View::make('org.home', array(
            'content' => Page::where('name', 'home')->firstOrFail()->content
        ));
    });

    Route::get('login', function()
    {
        return View::make('org.login', array('email' => Input::old('email')));
    });

    Route::post('login', function()
    {
        if (Auth::attempt(array('username' => Input::get('email'), 'password' => Input::get('password'))))
        {
            if (Auth::user()->role_id >= 50)
            {
                return Redirect::intended('admin');
            }

            return Redirect::intended('member');
        }

        return Redirect::to('org/login')->with('error', true)->with('reason', 'alerts.invalid_login')->withInput();
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
        return Password::remind(array('username' => Input::get('email')), function ($message, $user)
        {
            $message->subject('Password reminder');
        });
    });

    Route::get('reset/{token}', function($token)
    {
        return View::make('org.reset')->with('token', $token);
    });

    Route::post('reset/{token}', function()
    {
        $credentials = array('username' => Input::get('email'));

        return Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);


            if (Auth::user()->role_id >= 50) {
                return Redirect::to('admin');
            }

            return Redirect::to('member');
        });
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
